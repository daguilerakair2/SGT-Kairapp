/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/views/*/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        colors: {
            transparent: 'transparent',
            'green-custom': {
                '200': '#c2e1d7',
                '500': '#86c3b0'
            },
            'gray-custom': {
                '50': '#ececec',
                '600': '#292929'
            },
            'pink-custom': {
                '600': '#c9217b',
                '850': '#95185b'
            }
        },
    },
    plugins: [
        require('flowbite/plugin')({
            charts: true,
        })
    ],
}
