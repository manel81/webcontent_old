module.exports = {
  extends: ['pronovix'],
  rules: {
    'import/prefer-default-export': 'off',
    'react/require-default-props': [2, { ignoreFunctionalComponents: true }],
  },
  env: {
    jest: true,
  },
};
