module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                'cabin': ['Cabin', 'sans-serif']
            },
            zIndex: {
                '25': 25,
                '50': 50,
                '75': 75,
                '100': 100,
            },
            maxHeight: {
                '0': '0',
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                'full': '100%',
            }

        },
    },
    variants: {
        extend: {
            divideColor: ['group-hover'],
            flex: ['hover', 'focus'],
        },
    },
    plugins: [],
}
