module.exports = {
  root: true,
  env: {
    browser: true,
    es2021: true
  },
  extends: ['eslint:recommended'],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module'
  },
  rules: {
    'no-console': ['warn', { allow: ['warn', 'error'] }]
  },
  globals: {
    AOS: 'readonly',
    tf: 'readonly',
    mobilenet: 'readonly'
  }
};
