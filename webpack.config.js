const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

const isProduction = process.env.NODE_ENV === "production";

module.exports = {
  mode: isProduction ? "production" : "development",
  entry: {
    // CSS files.
    main: "./assets/css/main.css",
    utilities: "./assets/css/utilities.css",
  },
  output: {
    path: path.resolve(__dirname, "dist"),
    filename: "js/[name].js",
  },
  plugins: [
    // Remove the extra JS files Webpack creates for CSS entries.
    // This should be fixed in Webpack 5.
    new FixStyleOnlyEntriesPlugin({
      silent: true,
    }),

    // Clean the `dist` folder on build.
    new CleanWebpackPlugin({
      cleanStaleWebpackAssets: false,
    }),

    // Extract CSS into individual files.
    new MiniCssExtractPlugin({
      filename: "css/[name].css",
      chunkFilename: "[id].css",
    }),

    new BrowserSyncPlugin(
      {
        host: "localhost",
        port: 3000,
        proxy: "tungdu.test",
        open: true,
        files: ["**/*.php", "dist/js/**/*.js", "dist/css/**/*.css"],
      },
      {
        injectCss: true,
        reload: false,
      }
    ),
  ],
  optimization: {
    splitChunks: {
      cacheGroups: {
        styles: {
          name: "app",
          test: /\.css$/,
          chunks: "all",
          enforce: true,
        },
      },
    },
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        exclude: /node_modules/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: "css-loader",
            options: {
              sourceMap: !isProduction,
              importLoaders: 1,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              sourceMap: !isProduction,
            },
          },
        ],
      },
    ],
  },
};
