<?php

namespace App\Console\Commands;

use App\Models\User\User;
use App\Models\Company;
use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SetupCompanyCommand extends Command
{
    protected $signature = 'app:setup-company {input?}';
    protected $description = 'Setup Company with interactive prompts';

    public function handle()
    {
        $input = $this->argument('input');
        $parsedInput = $this->parseInput($input);

        $this->info('Starting company setup...');

        // Use the parsed input as default values
        $companyName = $this->ask('Enter company name', $parsedInput['Company Name'] ?? 'New Company');
        $shortName = $this->ask('Enter company short name', $parsedInput['Short Name'] ?? Str::before($companyName, ' '));
        $address = $this->ask('Enter company address', $parsedInput['Address'] ?? 'Baghdad, Iraq');

        $company = Company::create([
            'name' => $companyName,
            'short_name' => $shortName,
            'address' => $address,
        ]);

        // Create default configurations
        $this->createLeadSources($company);
        $this->createLeadStatuses($company);
        $this->createRealEstatePurposes($company);
        $this->createRealEstateTypes($company);
        $departments = $this->createDepartments($company);

        // Administrator User Information
        $defaultUsername = Str::snake($shortName);
        $userName = $this->ask('Enter administrator name', $parsedInput['Admin Username'] ?? $companyName);
        $userUsername = $this->ask('Enter administrator username', $parsedInput['Admin Username'] ?? $defaultUsername);
        $userEmail = $this->ask('Enter administrator email', $parsedInput['Admin Email'] ?? "{$userUsername}@homele.com");
        $userPhone = $this->ask('Enter administrator phone', $parsedInput['Admin Phone'] ?? '+9647701112233');
        $userPassword = $this->secret('Enter administrator password') ?? $defaultUsername . '#$0111';

        $user = User::factory()->create([
            'company_id' => $company->id,
            'name' => $userName,
            'username' => $userUsername,
            'email' => $userEmail,
            'phone' => $userPhone,
            'password' => bcrypt($userPassword),
            'department_id' => $departments['management']->id,
            'position' => 'Administrator',
            'is_active' => true,
        ]);

        $user->assignRole('administrator');
        $user->givePermissionTo(Permission::get()->pluck('name'));

        $this->info('Company setup completed successfully!');
        $this->displaySetupTable($companyName, $shortName, $address, $userUsername, $userEmail, $userPhone);
    }

    private function parseInput($input)
    {
        $data = [];
        if ($input) {
            $pattern = '/\|\s(.*?)\s\|\s(.*?)\s\|/';  // Simple regex to parse "| key | value |" lines
            preg_match_all($pattern, $input, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $data[$match[1]] = $match[2];
            }
        }
        return $data;
    }

    private function createLeadSources($company)
    {
        $defaultSources = [
            'Direct',
            'Facebook',
            'Instagram',
            'Twitter',
            'LinkedIn',
            'Google',
            'Referral',
            'Email',
            'Phone',
            'Walk-in',
            'Event',
            'Other'
        ];

        $company->lead_sources()->createMany(
            array_map(fn($name) => ['name' => $name], $defaultSources)
        );
    }

    private function createLeadStatuses($company)
    {
        $statuses = [
            ['name' => 'New', 'color' => 'blue-500'],
            ['name' => 'Qualified', 'color' => 'indigo-500'],
            ['name' => 'Lost', 'color' => 'red-500'],
            ['name' => 'Won', 'color' => 'green-500'],
            ['name' => 'No Answer', 'color' => 'yellow-700'],
            ['name' => 'No Answer 2', 'color' => 'yellow-500'],
            ['name' => 'No Answer 3', 'color' => 'yellow-100'],
            ['name' => 'No Answer 4', 'color' => 'red-500'],
        ];

        $company->lead_statuses()->createMany($statuses);
    }

    private function createRealEstatePurposes($company)
    {
        $purposes = ['For Sale', 'For Rent', 'Tourist Rental'];
        $company->realestate_purposes()->createMany(
            array_map(fn($name) => ['name' => $name], $purposes)
        );
    }

    private function createRealEstateTypes($company)
    {
        $types = [
            'Project',
            'Apartment',
            'Land',
            'Shops',
            'Stand Alone Villa',
            'Offices',
            'Buildings',
            'Hotels'
        ];

        $company->realestate_types()->createMany(
            array_map(fn($name) => ['name' => $name], $types)
        );
    }

    private function createDepartments($company)
    {
        $departments = [];
        $departmentNames = ['Sales', 'Marketing', 'Support', 'Management'];

        foreach ($departmentNames as $name) {
            $departments[strtolower($name)] = $company->departments()->create(['name' => $name]);
        }

        return $departments;
    }

    private function displaySetupTable($companyName, $shortName, $address, $userName, $userEmail, $userPhone)
    {
        $this->table(
            ['Item', 'Value'],
            [
                ['Company Name', $companyName],
                ['Short Name', $shortName],
                ['Address', $address],
                ['Admin Username', $userName],
                ['Admin Email', $userEmail],
                ['Admin Phone', $userPhone],
            ]
        );
    }
}
