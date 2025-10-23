import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(relativeTime);
import useClipboard from 'vue-clipboard3';
const { toClipboard } = useClipboard();

import Swal from 'sweetalert2';

export default {

    toast: (msg = '', type = 'success') => {
        const toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3500,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    },

    slugify: (text, seperator = '_') => {
        return text
            .toLowerCase() // Convert to lowercase
            .trim() // Remove whitespace from both ends of a string
            .replace(/[^\w\s.-]/g, '') // Remove all non-word chars except spaces, hyphens, and periods
            .replace(/[.\s_-]+/g, seperator) // Replace periods, spaces, and underscores with a single hyphen
            .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens

    },
    capitalizeWords: (arr) => {
        return arr.map(element => {
            return element.charAt(0).toUpperCase() + element.substring(1).toLowerCase();
        });
    },

    makeReadable: (key) => {
        return this.capitalizeWords(key.replaceAll('_', ' ').split(' ')).join(' ');
    },

    capitalizeWord: (word) => {
        return word.charAt(0).toUpperCase() + word.substring(1).toLowerCase();
    },

    isFirstKey: (array, index = 0) => {
        return Object.keys(array)?.shift() == index;
    },
    formatCustomDate: (date, full_date = false) => {
        if (!date) {
            return date;
        }

        let $return = '';
        try {
            const now = dayjs();
            const target = dayjs(date);

            if (full_date) {
                $return = target.format('MMM D, YYYY [at] hh:mm A');
            } else if (target.isSame(now, 'day')) {
                $return = `Today at ${target.format('hh:mm A')}`;
            } else if (target.isSame(now.subtract(1, 'day'), 'day')) {
                $return = `Yesterday at ${target.format('hh:mm A')}`;
            } else if (target.isSame(now.add(1, 'day'), 'day')) {
                $return = `Tomorrow at ${target.format('hh:mm A')}`;
            } else {
                $return = target.format('MMM D [at] hh:mm A');
            }
        } catch (error) {
            $return = date;
        }

        return $return;
    },

    formatDate: (date, format = 'YYYY-MM-DD') => {
        return dayjs(date).format(format);
    },

    formatDateTime(date, format = 'YYYY-MM-DD hh:mm A') {
        return dayjs(date).format(format);
    },

    formatPhoneNumber(number) {
        if (!number) {
            return '';
        }
        // Remove all non-digit characters
        let cleaned = number.replace(/\D+/g, '');

        // Check if the number starts with the country code +964 or +962
        if (cleaned.startsWith('964')) {
            // Assume the number includes the country code and format accordingly
            return `+(${cleaned.substring(0, 3)}) ${cleaned.substring(3, 6)}-${cleaned.substring(6, 9)}-${cleaned.substring(9)}`;
        } else if (cleaned.startsWith('07')) {
            // Local mobile number without international code, trim the leading zero
            cleaned = cleaned.substring(1);
        }

        // Check if the number is a local mobile number without international code
        if (cleaned.length === 10) {
            // Format as a local number
            return `(${cleaned.substring(0, 3)}) ${cleaned.substring(3, 5)}-${cleaned.substring(5)}`;
        }

        // If the number doesn't fit any known pattern, return it unmodified
        return number;
    },
    number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep =
                typeof thousands_sep === "undefined" ? "," : thousands_sep,
            dec = typeof dec_point === "undefined" ? "." : dec_point,
            s = "",
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return "" + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || "").length < prec) {
            s[1] = s[1] || "";
            s[1] += new Array(prec - s[1].length + 1).join("0");
        }
        return s.join(dec);
    },
    formatPrice(amount, currency) {
        if (!amount) {
            return '';
        }

        if (!currency) {
            return this.number_format(amount, 2);
        }

        let result = '';
        if (currency.before_amount) {
            result = currency.symbol + currency.prefix + this.number_format(amount, 2) + currency.suffix;
        } else {
            result = currency.prefix + this.number_format(amount, 2) + currency.suffix + currency.symbol;
        }
        return result;
    },
    async copyClipboard(text) {
        if (text) {
            await toClipboard(text);
        }
    },
    updateDatatableColumnVisibility(col, visablility, cols) {
        col.hide = !visablility;

        const page_key = this.slugify(route().current());
        localStorage.setItem(`${page_key}_columns`, JSON.stringify((cols).map(col => {
            return {
                field: col.field,
                hide: col.hide
            }
        })))

    },
    getDatatableColumnVisibility(col) {
        const page_key = this.slugify(route().current());
        const columns = JSON.parse(localStorage.getItem(`${page_key}_columns`));
        if (columns) {
            const column = columns.find(column => column.field == col.field);
            if (column) {
                col.hide = column.hide;
            }
        }

        return col;
    },
    truncateText(text, length = 30) {
        text = text || '';
        return text.length > length ? text.substring(0, length) + '...' : text;
    },
    log(...args) {
        console.log(...args);
        return args;
    },
    openUrl(url) {
        if (typeof window !== 'undefined') {
            window.open(url, '_blank');
        }
    },
    // generate a random username we use it in different places
    generateUsername(prefix = 'client_', length = 8) {
        const chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        let randomStr = '';
        for (let i = 0; i < length; i++) {
            randomStr += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return prefix + randomStr;
    },

    // generate a random password we use it in different places
    generatePassword(length = 12) {
        const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|';
        let password = '';
        for (let i = 0; i < length; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return password;
    },

    // i created this function to get the id of that object
    getObjectById(rawId, data) {
        const exampleType = data?.[0]?.id;
        const id = typeof exampleType === 'number' ? Number(rawId) : String(rawId);
        return data.find(opt => opt.id === id) || null;
    },

    /**
     * Get translated value from multilingual object
     * Useful for Spatie Translatable models that return: {"en": "...", "ckb": "...", "ar": "..."}
     * 
     * @param {Object|String} obj - Translation object or plain string
     * @param {String} locale - Specific locale to use (optional, defaults to browser/page locale)
     * @returns {String} Translated text with fallback chain: requested locale → 'en' → first available
     * 
     * @example
     * getTranslation({en: 'Hello', ckb: 'سڵاو', ar: 'مرحبا'}, 'ckb') // Returns: 'سڵاو'
     * getTranslation('Plain text') // Returns: 'Plain text'
     * getTranslation(null) // Returns: ''
     */
    getTranslation(obj, locale = null) {
        // Handle null/undefined
        if (!obj) return '';
        
        // If already a string, return as is
        if (typeof obj === 'string') return obj;
        
        // Determine which locale to use
        const targetLocale = locale || document.documentElement.lang || 'en';
        
        // Return translation with fallback chain
        return obj[targetLocale] || obj['en'] || obj[Object.keys(obj)[0]] || '';
    },

    /**
     * Generate branch-aware URL for frontend routes
     * Automatically prepends the selected branch slug to paths when available
     * 
     * @param {String} path - The path to navigate to (e.g., '/about', '/news')
     * @param {String|null} branchSlug - Optional branch slug override (defaults to current branch from page props)
     * @returns {String} Full path with branch prefix if applicable
     * 
     * @example
     * branchRoute('/about') // Returns: '/kurd-genius/about' (if kurd-genius is selected)
     * branchRoute('/') // Returns: '/kurd-genius' (if kurd-genius is selected)
     * branchRoute('/news', 'smart-education') // Returns: '/smart-education/news'
     */
    branchRoute(path, branchSlug = null) {
        // Try to get branch prefix from page props (Inertia)
        const branchPrefix = branchSlug || 
            (typeof window !== 'undefined' && window.$page?.props?.branchPrefix) || '';
        
        if (!branchPrefix) return path;
        
        // Handle root path
        if (path === '/' || path === '') {
            return `/${branchPrefix}`;
        }
        
                // Ensure path starts with /
        const cleanPath = path.startsWith('/') ? path : `/${path}`;
        return `/${branchPrefix}${cleanPath}`;
    }

}