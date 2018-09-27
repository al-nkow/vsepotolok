const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const autoprefixer = require('autoprefixer');
const Dotenv = require('dotenv-webpack');

const conf = {
  entry: './src/js/index.js',
  output: {
    path: path.resolve(__dirname, './dist'),
    // filename: 'main.js'
    filename: '[name].[chunkhash].js'
  },
  devServer: {
    overlay: true
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
      },
      {
        test: /\.pug$/,
        use: 'pug-loader',
        // options: {
        //   pretty: true
        // }
      },
      {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          use: 'css-loader'
        })
      }, {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          use: [
            {
              loader: 'css-loader',
              options: {
                minimize: true
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                plugins: [
                  autoprefixer({
                    browsers:['ie >= 8', 'last 4 version']
                  })
                ],
                // sourceMap: true
              }
            },
            'sass-loader'
          ]
        })
      }, {
        test: /\.html$/,
        use: ['html-loader']
      },
      {
        test: /\.(gif|png|jpe?g)$/i,
        use: [{
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: 'img/',
            publicPath: 'img/'
          }
        }]
      },
      // ===== FONTS =====
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [{
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: 'fonts/'
          }
        }]
      },
      // ===== PDF =====
      {
        test: /\.pdf$/,
        use: [{
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: 'docs/',
            publicPath: 'docs/'
          }
        }]
      },
      // ===== FAVICON =====
      {
        test: /\.ico$/,
        use: [{
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: '/',
            publicPath: '/'
          }
        }]
      },
    ]
  },
  plugins: [
    new Dotenv(),
    new HtmlWebpackPlugin({
      filename: 'index.html',
      template: './src/index.pug'
    }),
    new ExtractTextPlugin('styles-[hash:6].css')
  ]
};

module.exports = (env, options) => {
  if (options.mode !== 'production') {
    conf.devtool = 'eval-sourcemap';
  }
  return conf;
};