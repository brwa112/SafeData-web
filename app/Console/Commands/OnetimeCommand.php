<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\Company;
use App\Models\CRM\Call;
use App\Models\CRM\Deal;
use App\Models\CRM\Note;
use App\Models\CRM\Task;
use App\Models\CRM\Visit;
use App\Models\User\User;
use App\Models\Permission;
use App\Models\CRM\Meeting;
use App\Models\CRM\Customer;
use App\Models\Location\City;
use Illuminate\Console\Command;
use App\Models\Location\Country;
use App\Models\CRM\RealEstateType;
use Illuminate\Support\Facades\DB;

class OnetimeCommand extends Command
{
    protected $signature = 'app:onetime {method?}';

    protected $description = 'One time command';

    public function handle()
    {
        @ini_set('memory_limit', '-1');

        if ($this->argument('method')) {
            $this->{$this->argument('method')}();
            return;
        }

        $all_methods = get_class_methods($this);
        $cons_key = array_search('__construct', $all_methods);
        $my_methods = collect($all_methods)->filter(fn($method, $key) => $key < $cons_key && $method != 'handle')->reverse()->toArray();

        if (empty($my_methods)) {
            $this->error('No method found to run');
            return;
        }

        $method = $this->choice('Which method you want to run?', $my_methods);
        $this->{$method}();
        return;
    }

    public function sequential_numbers()
    {
        $this->info('Sequential numbers');

        Company::with([
            'users' => fn($query) => $query->with_deactive()->withTrashed()->oldest(),
            'customers' => fn($query) => $query->oldest(),
            'notes' => fn($query) => $query->oldest(),
            'calls' => fn($query) => $query->oldest(),
            'tasks' => fn($query) => $query->oldest(),
            'deals' => fn($query) => $query->oldest(),
            'meetings' => fn($query) => $query->oldest(),
            'visits' => fn($query) => $query->oldest(),
            'lead_statuses' => fn($query) => $query->oldest(),
            'lead_sources' => fn($query) => $query->oldest(),
            'departments' => fn($query) => $query->oldest(),
            'real_estate_types' => fn($query) => $query->oldest(),
        ])->get()
            ->each(function ($company) {
                $company->customers->each(function ($customer) {
                    $customer->sequential_number = $customer->getNextSequence();
                    $customer->saveQuietly();
                });

                $company->notes->each(function ($note) {
                    $note->sequential_number = $note->getNextSequence();
                    $note->saveQuietly();
                });

                $company->calls->each(function ($call) {
                    $call->sequential_number = $call->getNextSequence();
                    $call->saveQuietly();
                });

                $company->tasks->each(function ($task) {
                    $task->sequential_number = $task->getNextSequence();
                    $task->saveQuietly();
                });

                $company->deals->each(function ($deal) {
                    $deal->sequential_number = $deal->getNextSequence();
                    $deal->saveQuietly();
                });

                $company->meetings->each(function ($meeting) {
                    $meeting->sequential_number = $meeting->getNextSequence();
                    $meeting->saveQuietly();
                });

                $company->visits->each(function ($visit) {
                    $visit->sequential_number = $visit->getNextSequence();
                    $visit->saveQuietly();
                });

                $company->lead_statuses->each(function ($lead_status) {
                    $lead_status->sequential_number = $lead_status->getNextSequence();
                    $lead_status->saveQuietly();
                });

                $company->lead_sources->each(function ($lead_source) {
                    $lead_source->sequential_number = $lead_source->getNextSequence();
                    $lead_source->saveQuietly();
                });

                $company->departments->each(function ($department) {
                    $department->sequential_number = $department->getNextSequence();
                    $department->saveQuietly();
                });

                $company->real_estate_types->each(function ($real_estate_type) {
                    $real_estate_type->sequential_number = $real_estate_type->getNextSequence();
                    $real_estate_type->saveQuietly();
                });

                $company->users->each(function ($user) {
                    $user->sequential_number = $user->getNextSequence();
                    $user->saveQuietly();
                });

                $this->info('Sequential numbers updated for ' . $company->name);
            });

        $this->info('Sequential numbers updated');
    }

    public function export_permissions()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'customers' => [
                'export',
                'see_contact',
            ],

            'notes' => [
                'export'
            ],

            'calls' => [
                'export'
            ],

            'tasks' => [
                'export'
            ],

            'deals' => [
                'export'
            ],

            'meetings' => [
                'export'
            ],

            'visits' => [
                'export'
            ],
        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $perm) {
                Permission::firstOrCreate(['name' => $perm . '_' . $group, 'group' => $group, 'guard_name' => 'web']);
            }
        }

        $companies = Company::get();

        // First create the permissions if they don't exist
        $permissions = [
            'export_customers',
            'export_notes',
            'export_calls',
            'export_tasks',
            'export_deals',
            'export_meetings',
            'export_visits',
            'see_contact_customers',
        ];

        // foreach ($permissions as $permission) {
        //     Permission::firstOrCreate([
        //         'name' => $permission,
        //         'guard_name' => 'web',
        //     ]);
        // }

        // foreach ($permissions as $group => $perms) {
        //     foreach ($perms as $perm) {
        //         Permission::firstOrCreate(['name' => $perm . '_' . $group, 'group' => $group]);
        //     }
        // }

        $companies->each(function ($company) use ($permissions) {

            $administrators = $company->users()->get();

            $administrators->each(function ($administrator) use ($permissions) {
                $administrator->givePermissionTo($permissions);
            });

            $this->info('Permissions assigned to ' . $company->name);
        });


        return;

        $administrators = User::whereHas('roles', fn($query) => $query->where('name', 'administrator'))->get();

        $administrators->each(function ($administrator) {

            $this->info('Assigning to ' . $administrator->name);

            $administrator->givePermissionTo([
                'export_customers',
                'export_notes',
                'export_calls',
                'export_tasks',
                'export_deals',
                'export_meetings',
                'export_visits',
                'export_users',
            ]);
        });


        $this->info('Customer permission assigned');
    }

    // Clone RealEstateType for all companies
    public function clone_real_estate_types()
    {
        $this->info('Cloning real estate types');

        DB::beginTransaction();

        $companies = Company::where('id', '!=', 1)->get();

        $realEstateTypes = RealEstateType::get();

        foreach ($companies as $company) {
            $realEstateTypes->each(function ($realEstateType) use ($company) {
                $newRealEstateType = $realEstateType->replicate();
                $newRealEstateType->company_id = $company->id;

                $newRealEstateType->save();

                $this->info('Real estate type cloned');

                $company->customers()->each(function ($customer) use ($newRealEstateType, $realEstateType) {
                    $customer->real_estate_types()->where('real_estate_type_id', $realEstateType->id)->update([
                        'real_estate_type_id' => $newRealEstateType->id
                    ]);
                });
            });
        }

        DB::commit();

        $this->info('Real estate types cloned');
    }

    public function real_estate_types_permissions()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'real_estate_types' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $perm) {
                Permission::firstOrCreate(['name' => $perm . '_' . $group, 'group' => $group]);
            }
        }

        $administrators = User::whereHas('roles', fn($query) => $query->where('name', 'administrator'))->get();

        $administrators->each(function ($administrator) {

            $this->info('Assigning to ' . $administrator->name);

            $administrator->givePermissionTo([
                'view_real_estate_types',
                'create_real_estate_types',
                'edit_real_estate_types',
                'delete_real_estate_types',
            ]);
        });


        $this->info('Customer permission assigned');
    }

    public function add_halabja()
    {
        $this->info('Adding more cities.');

        $cities = [
            [
                'country_id' => 1,
                'name' => 'Halabja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        City::insert($cities);
    }

    // Clone company and its related data to new company
    public function clone_company()
    {
        DB::transaction(function () {

            // Get all companies
            $company = Company::get();

            $selected_company = $this->choice('Which company you want to clone?', $company->pluck('name')->toArray());

            $company = Company::where('name', $selected_company)->first();

            // Clone company
            $new_company = $company->replicate();
            $new_company->name = $company->name . ' - Clone';

            // if (Company::where('name', $new_company->name)->exists()) {
            //     $this->error('Company already exists');
            //     return;
            // }

            $new_company->save();
            $this->info('Company cloned');

            // Clone company roles
            $roles = $company->roles()->get();
            $new_company->roles()->sync($roles->pluck('id'));
            $this->info('Roles cloned');

            // Clone company permissions
            $permissions = $company->permissions()->get();
            $new_company->permissions()->sync($permissions->pluck('id'));

            $this->info('Permissions cloned');

            // Clone company lead statuses
            $lead_statuses = $company->lead_statuses()->get();
            $new_company->lead_statuses()->createMany($lead_statuses->toArray());

            $this->info('Lead statuses cloned');

            // Clone company lead sources
            $lead_sources = $company->lead_sources()->get();
            $new_company->lead_sources()->createMany($lead_sources->toArray());

            $this->info('Lead sources cloned');

            // Clone company departments

            $departments = $company->departments()->get();
            $new_company->departments()->createMany($departments->toArray());

            $this->info('Departments cloned');

            // Clone company users
            $users = $company->load([
                'users' => fn($query) => $query->whereHas('customers')
            ])->users;

            // Clone users
            $users->each(function ($user) use ($new_company) {
                $new_user = $user->replicate();
                $new_user->company_id = $new_company->id;

                $new_user->department_id = $new_company->departments()->inRandomOrder()->first()->id;

                // $new_user->name = fake()->unique()->name();
                $new_user->username = fake()->unique()->userName();

                $new_user->email = fake()->unique()->safeEmail();

                $new_user->password = bcrypt(null);

                $new_user->phone = '07' . fake()->numberBetween(8, 9) . '0' . fake()->unique()->numberBetween(1000000, 9999999);

                $new_user->save();

                $this->info('User cloned');

                // Clone user roles
                $roles = $user->roles()->get();
                $new_user->roles()->sync($roles->pluck('id'));

                $this->info('User roles cloned');

                // Clone user permissions
                $permissions = $user->permissions()->get();
                $new_user->permissions()->sync($permissions->pluck('id'));

                $this->info('User permissions cloned');

                // Clone user customers
                $customers = $user->customers()->get();

                $customers->each(function ($customer) use ($new_user) {
                    // Clone customer
                    $new_customer = $customer->replicate();

                    $new_customer->company_id = $new_user->company_id;
                    $new_customer->owner_id = $new_user->id;
                    $new_customer->created_by = $new_user->id;

                    $new_customer->lead_status_id = $new_user->company->lead_statuses()->inRandomOrder()->first()->id;
                    $new_customer->lead_source_id = $new_user->company->lead_sources()->inRandomOrder()->first()->id;

                    unset($new_customer->name);

                    $new_customer->save();

                    $this->info('Customer cloned');

                    // Clone customer notes
                    $notes = $customer->notes()->get();
                    $notes->each(function ($note) use ($new_customer, $new_user) {
                        $new_note = $note->replicate();
                        $new_note->company_id = $new_user->company_id;
                        $new_note->customer_id = $new_customer->id;
                        $new_note->owner_id = $new_user->id;
                        $new_note->created_by = $new_user->id;

                        $new_note->save();
                    });

                    $this->info('Customer notes cloned');

                    // Clone customer calls
                    $calls = $customer->calls()->get();
                    $calls->each(function ($call) use ($new_customer, $new_user) {
                        $new_call = $call->replicate();
                        $new_call->company_id = $new_user->company_id;
                        $new_call->customer_id = $new_customer->id;
                        $new_call->contacted_id = $new_user->id;
                        $new_call->created_by = $new_user->id;

                        $new_call->save();
                    });

                    $this->info('Customer calls cloned');

                    // Clone customer tasks
                    $tasks = $customer->tasks()->get();
                    $tasks->each(function ($task) use ($new_customer, $new_user) {
                        $new_task = $task->replicate();
                        $new_task->company_id = $new_user->company_id;
                        $new_task->customer_id = $new_customer->id;
                        $new_task->assigned_to_id = $new_user->id;
                        $new_task->created_by = $new_user->id;

                        $new_task->save();
                    });

                    $this->info('Customer tasks cloned');

                    // Clone customer deals
                    $deals = $customer->deals()->get();

                    $deals->each(function ($deal) use ($new_customer, $new_user) {
                        $new_deal = $deal->replicate();
                        $new_deal->company_id = $new_user->company_id;
                        $new_deal->customer_id = $new_customer->id;
                        $new_deal->owner_id = $new_user->id;
                        $new_deal->created_by = $new_user->id;

                        $new_deal->save();
                    });

                    $this->info('Customer deals cloned');

                    // Clone customer meetings
                    $meetings = $customer->meetings()->get();

                    $meetings->each(function ($meeting) use ($new_customer, $new_user) {
                        $new_meeting = $meeting->replicate();
                        $new_meeting->company_id = $new_user->company_id;
                        $new_meeting->customer_id = $new_customer->id;
                        $new_meeting->meeting_by_id = $new_user->id;
                        $new_meeting->created_by = $new_user->id;

                        $new_meeting->save();
                    });


                    $this->info('Customer meetings cloned');

                    // Clone customer visits
                    $visits = $customer->visits()->get();

                    $visits->each(function ($visit) use ($new_customer, $new_user) {
                        $new_visit = $visit->replicate();
                        $new_visit->company_id = $new_user->company_id;
                        $new_visit->customer_id = $new_customer->id;
                        $new_visit->visit_by_id = $new_user->id;
                        $new_visit->created_by = $new_user->id;

                        $new_visit->save();
                    });

                    $this->info('Customer visits cloned');
                });

                $this->info('User customers cloned');
            });

            // dda($users);

        });
    }

    // make super admin and developer is_hidden = 1
    public function make_super_admin_and_developer_hidden()
    {
        $super_admin_role = Role::query()
            ->withoutGlobalScope('hidden')
            ->where('name', 'super admin')
            ->first();

        $super_admin_role->is_hidden = 1;
        $super_admin_role->save();

        $this->info('Super admin role is hidden');

        $developer_role = Role::query()
            ->withoutGlobalScope('hidden')
            ->where('name', 'developer')
            ->first();

        $developer_role->is_hidden = 1;
        $developer_role->save();

        $this->info('Developer role is hidden');
    }

    // create developer role and account for it
    public function create_developer_role()
    {
        $developerRole = Role::firstOrCreate([
            'name' => 'developer',
        ], [
            'title' => 'Developer',

            'description' => 'Access to developer related features',
            'guard_name' => 'web'
        ]);

        $developerRole->is_hidden = 1;
        $developerRole->save();

        $user = User::firstOrcreate([
            'username' => 'developer',
        ], [
            'name' => 'Developer',
            'username' => 'developer',
            'email' => 'tech@homele.com',
            'password' => bcrypt('SJDbpendABaX2TDyDt1JZLZGY'),
        ]);

        $user->assignRole($developerRole);
        $user->assignRole('super admin');
    }


    public function create_super_admin_with_its_permissions()
    {
        // $permissions = [
        //     'companies' => [
        //         'view',
        //         'create',
        //         'edit',
        //         'delete'
        //     ],
        // ];

        // $_permissions = [];

        // // Create permissions and assign them to groups with the 'company' guard
        // foreach ($permissions as $group => $perms) {
        //     foreach ($perms as $perm) {

        //         $name  = $perm . '_' . $group;

        //         Permission::firstOrCreate([
        //             'name' => $name,
        //             'group' => $group,
        //             'guard_name' => 'web',

        //         ]);

        //         $_permissions[] = $name;
        //     }
        // }

        // Create roles with the 'company' guard
        $superAdminRole = Role::firstOrCreate([
            'title' => 'Super Admin',
            'name' => 'super admin',
            'description' => 'Access to companies related features',
            'guard_name' => 'web'
        ]);

        // Assign permissions to the role
        // $superAdminRole->givePermissionTo($_permissions);

        $user = User::firstOrcreate([
            'username' => 'super admin',
        ], [
            'name' => 'Super Admin',
            'username' => 'super admin',
            'email' => 'super@homele.com',
            'password' => bcrypt('eSB79Fu7y9KmHFZ5033v'),
        ]);

        $user->assignRole($superAdminRole);

        // $user->givePermissionTo($_permissions);
    }

    public function owner_id_to_created_by()
    {
        $this->info('Call');
        Call::query()->withTrashed()->update(['created_by' => DB::raw('contacted_id')]);

        $this->info('Customer');
        Customer::query()->withTrashed()->update(['created_by' => DB::raw('owner_id')]);

        $this->info('Deal');
        Deal::query()->withTrashed()->update(['created_by' => DB::raw('owner_id')]);

        $this->info('Meeting');
        Meeting::query()->withTrashed()->update(['created_by' => DB::raw('meeting_by_id')]);

        $this->info('Task');
        Task::query()->withTrashed()->update(['created_by' => DB::raw('assigned_to_id')]);

        $this->info('Visit');
        Visit::query()->withTrashed()->update(['created_by' => DB::raw('visit_by_id')]);

        $this->info('Note');
        Note::query()->withTrashed()->update(['created_by' => DB::raw('owner_id')]);

        $this->info('Done');
    }

    public function add_more_cities()
    {
        $this->info('Adding more cities.');

        $cities = [
            [
                'country_id' => 1,
                'name' => 'Wasit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        City::insert($cities);
    }

    // cities
    public function add_cities()
    {
        $this->info('Adding cities.');

        $cities = [
            [
                'country_id' => 1,
                'name' => 'Erbil',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Sulaymaniyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Baghdad',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Kirkuk',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Kalar',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Karbala',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Mosul',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Basrah',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Duhok',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Najaf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Nasriyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Shaqlawa',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Al Anbar',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'country_id' => 1,
                'name' => 'Salahadin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Soran',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Koysinjaq',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Al Faluja',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Diyala',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Choman',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Hillah',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'country_id' => 1,
                'name' => 'Ranya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        City::insert($cities);
    }

    public function add_country()
    {
        $this->info('Adding country and city.');

        $countries = [
            [
                'id' => 1,
                'name' => 'Iraq',
                'code' => 'IQ',
            ],
            [
                'id' => 2,
                'name' => 'Turkey',
                'code' => 'TR',
            ],
            [
                'id' => 3,
                'name' => 'United Arab Emirates',
                'code' => 'AE',
            ],
        ];

        Country::insert($countries);
    }

    // access any permission
    public function access_any_permission()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions in a grouped structure
        $permissions = [
            'customers' => [
                'access_any'
            ],
            'notes' => [
                'access_any'
            ],
            'calls' => [
                'access_any'
            ],
            'tasks' => [
                'access_any'
            ],
            'deals' => [
                'access_any'
            ],
            'meetings' => [
                'access_any'
            ],
            'visits' => [
                'access_any'
            ],
        ];

        // Create permissions and assign them to groups
        foreach ($permissions as $group => $perms) {
            foreach ($perms as $perm) {
                Permission::updateOrCreate(
                    ['name' => 'view_any_' . $group],
                    ['name' => $perm . '_' . $group,]
                );
            }
        }

        $administrator = Role::findByName('administrator')->first();

        $administrator->givePermissionTo([
            'access_any_customers',
            'access_any_notes',
            'access_any_calls',
            'access_any_tasks',
            'access_any_deals',
            'access_any_meetings',
            'access_any_visits',
        ]);
    }

    // public function assign_customer_permission()
    // {
    //     app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    //     $this->info('Assigning customer permission');

    //     $permissions = [
    //         'customers' => [
    //             'assign'
    //         ],
    //     ];

    //     foreach ($permissions as $group => $perms) {
    //         foreach ($perms as $perm) {
    //             Permission::firstOrCreate(['name' => $perm . '_' . $group, 'group' => $group]);
    //         }
    //     }

    //     $administrator = Role::findByName('administrator')->first();

    //     $administrator->givePermissionTo('assign_customers');

    //     $support = Role::where('name', 'support')->first();

    //     $support->givePermissionTo([
    //         'assign_customers',
    //         'view_customers',
    //         'create_customers',
    //         'edit_customers',
    //     ]);

    //     $this->info('Customer permission assigned');
    // }

    // public function assign_company_permission()
    // {
    //     $permissions = [
    //         'view',
    //         'view_any',
    //         'create',
    //         'edit',
    //         'delete'
    //     ];

    //     foreach ($permissions as $perm) {
    //         Permission::create(['name' => $perm . '_companies', 'group' => 'companies']);
    //     }
    // }

}
