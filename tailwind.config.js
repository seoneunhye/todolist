// tailwind.config.js
module.exports = {
    content: ["./src/**/*.{html,js}"],
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
