const autoprefixer = require("autoprefixer");

module.exports = {
  plugins: [
    autoprefixer({
      Browserslist: ["last 3 versions", "> 1%"],
    }),
  ],
};
