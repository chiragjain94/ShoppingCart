// const path = require("path");
// module.exports = {
//   entry: "./inc/js/index.js",
//   mode: "development",

//   output: {
//     filename: "main.js",
//     path: path.resolve(__dirname, "dist")
//   }
// };
const path = require("path");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const webpack = require("webpack");

module.exports = {
  entry: "./inc/js/index.js",
  mode: "development",
  output: {
    filename: "main.js",
    path: path.resolve(__dirname, "dist")
  },
  devtool: "inline-source-map",
  plugins: [
    new ExtractTextPlugin({
      filename: "main.css",
      allChunks: true,
      disable: true
    }),
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery",
      Popper: ["popper.js", "default"],
      Util: "exports-loader?Util!bootstrap/js/dist/util"
    })
  ],
  module: {
    rules: [
      {
        test: /\.(css|scss|sass)$/,
        use: ExtractTextPlugin.extract({
          use: ["css-loader", "sass-loader"],
          fallback: ["style-loader"]
        })
      },
      {
        test: /\.html$/,
        use: [
          {
            loader: "html-loader",
            options: { minimize: true }
          }
        ]
      },
      {
        test: /\.(png|gif|jpg|svg|ttf|eot|woff2?)$/,
        use: "url-loader"
      }
    ]
  }
};
