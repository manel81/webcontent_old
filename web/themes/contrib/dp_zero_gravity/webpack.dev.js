const common = require('./webpack.common.js');
const entries = require('./webpack.entries.js');
const { merge } = require('webpack-merge');

module.exports = merge(entries, common, {
  mode: 'development',
});
