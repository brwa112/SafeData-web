export const getDefaultSettings = () => {
    return {
        isDarkMode: false,
        mainLayout: 'app',
        theme: 'light',
        menu: 'vertical',
        layout: 'full',
        rtlClass: 'ltr',
        animation: '',
        navbar: 'navbar-sticky',
        locale: 'en',
        sidebar: false,
        languageList: [
            { name: 'english', code: 'en' },
            { name: 'arabic', code: 'ar' },
            { name: 'kurdish', code: 'ckb' },
            { name: 'turkey', code: 'tr' }
        ],
        isShowMainLoader: true,
        semidark: false,
        toggleTheme: (payload) => {
            payload = payload || getDefaultSettings.theme; // light|dark|system
            localStorage.setItem('theme', payload || 'light');
            getDefaultSettings.theme = payload
            if (payload == 'light') {
                getDefaultSettings.isDarkMode = false;
            } else if (payload == 'dark') {
                getDefaultSettings.isDarkMode = true;
            }

            if (getDefaultSettings.isDarkMode) {
                document.querySelector('body')?.classList.add('dark');
            } else {
                document.querySelector('body')?.classList.remove('dark');
            }
        },
        changeLanguage: (lang) => {
            if (localStorage.getItem('language') == null) {
                localStorage.setItem('language', lang);
            }
            localStorage.setItem('language', lang);
        },
        toggleDir: (dir) => {
            dir = dir || getDefaultSettings.rtlClass; // rtl, ltr
            localStorage.setItem('rtlClass', dir || 'ltr');
            getDefaultSettings.rtlClass = dir;
            document.querySelector('html')?.setAttribute('dir', getDefaultSettings.rtlClass || 'ltr');
        },
    };
};