module.exports = function (api) {
  api.cache(false);
  const presets = [
    ['@babel/preset-react'],
    [
      '@babel/preset-env',
      {
        corejs: { version: 3 },
        useBuiltIns: 'usage',
        targets: {
          ie: '11',
        },
      },
    ],
  ];
  const plugins = [['@babel/plugin-proposal-class-properties'], ['@babel/plugin-transform-runtime']];
  return {
    presets,
    plugins,
  };
};
