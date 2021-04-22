const { merge } = require('webpack-merge');
const entries = require('./webpack.entries.js');
const CompressionPlugin = require('compression-webpack-plugin');
const zopfli = require('@gfx/zopfli');
const common = require('./webpack.common.js');

module.exports = merge(entries, common, {
  mode: 'production',
  plugins: [
    new CompressionPlugin({
      compressionOptions: {
        numiterations: 15,
      },
      algorithm(input, compressionOptions, callback) {
        return zopfli.gzip(input, compressionOptions, callback);
      },
    }),
  ],
});
