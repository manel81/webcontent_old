const path = require('path');
const exportSass = require('node-sass-export');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const outputPath = path.resolve(__dirname, 'dist');

module.exports = {
  resolve: {
    extensions: ['.js', '.jsx'],
  },
  output: {
    path: outputPath,
    filename: 'js/[name].js',
    chunkFilename: 'js/chunks/[name].js',
    publicPath: '../',
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendor: {
          chunks: 'initial',
          name: 'vendor',
          test: 'vendor',
          filename: 'js/vendor.js',
          enforce: true,
        },
      },
    },
  },
  plugins: [
    new CleanWebpackPlugin({ cleanAfterEveryBuildPatterns: ['!**/fonts/**/*.*', '!**/images/**/*.*'] }),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
  ],
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
      {
        test: /\.(sa|sc)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          'css-loader',
          'postcss-loader',
          {
            loader: 'sass-loader',
            options: {
              implementation: require('node-sass'),
              sassOptions: {
                functions: exportSass(__dirname),
              },
            },
          },
        ],
      },
      {
        test: /\.(png|jpg|jpeg|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: 'images',
            },
          },
        ],
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: 'fonts',
            },
          },
        ],
      },
    ],
  },
};
