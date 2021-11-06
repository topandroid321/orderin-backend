const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            screens: {
              sm: '480px',
              md: '768px',
              lg: '976px',
              xl: '1440px',
            },
        },
    },

    variants: {
        extend: {
          backgroundColor: ['active'],
          borderColor: ['focus-visible', 'first'],
          textColor: ['visited'],
        }
      },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
