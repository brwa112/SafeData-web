import { usePage } from '@inertiajs/vue3';

export default {
  install: (app) => {
    // Add global property for Options API
    app.config.globalProperties.$branchRoute = (path, branchSlug = null) => {
      const page = usePage();
      const branchPrefix = branchSlug || page.props.branchPrefix || '';
      
      if (!branchPrefix) return path;
      
      if (path === '/' || path === '') {
        return `/${branchPrefix}`;
      }
      
      const cleanPath = path.startsWith('/') ? path : `/${path}`;
      return `/${branchPrefix}${cleanPath}`;
    };

    // Add as a global mixin for template access in Composition API
    app.mixin({
      methods: {
        branchRoute(path, branchSlug = null) {
          const page = usePage();
          const branchPrefix = branchSlug || page.props.branchPrefix || '';
          
          if (!branchPrefix) return path;
          
          if (path === '/' || path === '') {
            return `/${branchPrefix}`;
          }
          
          const cleanPath = path.startsWith('/') ? path : `/${path}`;
          return `/${branchPrefix}${cleanPath}`;
        }
      }
    });
  }
};
