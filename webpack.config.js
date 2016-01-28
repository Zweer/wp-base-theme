'use strict';

const path = require('path');
const webpack = require('webpack');

module.exports = {
    cache: true,
    entry: {
        main: './_js/main.js'
    },
    output: {
        path: path.join(__dirname, 'js'),
        filename: '[name].js',
        chunkFilename: '[chunkhash].js'
    },
    plugins: [
        new webpack.ProvidePlugin({
            jQuery: "jquery",
            $: "jquery"
        }),
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        }),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.UglifyJsPlugin()
    ]
};