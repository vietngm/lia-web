"use strict";
const path = require("path");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
// const FileManagerPlugin = require("filemanager-webpack-plugin");

module.exports = {
	// mode: process.env.NODE_ENV === "production" ? "production" : "development",
	entry: [
		// path.resolve("./src/scripts/common.js"),
		path.resolve("./src/scripts/sync-data.js"),
		path.resolve("./src/scss/common.scss"),
	],
	devtool: false,
	mode: "production",
	output: {
		// path: path.resolve(__dirname, "../dist/wp-content/themes/liaSpeed/assets/"),
		// filename: "js/common.js",
		path: path.resolve(__dirname, "../dist/wp-content/plugins/sync-data/"),
		filename: "js/sync-data.js",
	},
	resolve: {
		extensions: [".ts", ".tsx", ".js", ".css"],
		alias: {
			jquery: path.join(__dirname, "node_modules/jquery/src/jquery"),
		},
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: "babel-loader",
						options: {
							presets: [
								[
									"@babel/preset-env",
									{
										targets: {
											browsers: ["chrome 58", "ie 10", "not dead"],
										},
									},
								],
							],
						},
					},
				],
			},
			{
				test: /\.css$/i,
				use: [MiniCssExtractPlugin.loader, "css-loader"],
				test: require.resolve("jquery"),
				use: [
					{
						loader: "expose-loader",
						options: "jQuery",
					},
					{
						loader: "expose-loader",
						options: "$",
					},
				],
			},
			{
				test: /\.(sa|sc|c)ss$/,
				use: [
					{
						loader: "style-loader",
					},
					{
						loader: "file-loader",
						options: {
							name: "css/[name].css",
						},
					},
					{
						loader: "extract-loader",
					},
					{
						loader: "css-loader?-url",
					},
					{
						loader: "postcss-loader",
					},
					{
						loader: "sass-loader",
					},
					{
						loader: "sass-resources-loader",
						options: {
							resources: [
								"./src/scss/variable.scss",
								// "./src/scss/common.scss",
								// "./src/scss/_layout.scss",
							],
						},
					},
				],
			},
			{
				test: /\.css$/,
				use: ["style-loader", "css-loader"],
			},
			{
				test: /\.(svg|eot|woff|woff2|ttf)$/,
				use: [
					{
						loader: "file-loader",
						options: {
							name: "[name].[ext]",
						},
					},
				],
			},
		],
	},
	plugins: [
		new BrowserSyncPlugin(
			{
				host: "localhost",
				port: 3002,
				proxy: "liaspeed:8888",
				open: false,
				files: [
					{
						match: ["../dist/**/*.css", "../dist/**/*.js", "../dist/**/*.php"],
						fn: (event, file) => {
							if (event == "change") {
								const bs = require("browser-sync").get("bs-webpack-plugin");
								if (
									file.split(".").pop() == "js" ||
									file.split(".").pop() == "php"
								) {
									bs.reload();
								} else {
									bs.reload("*.css");
								}
							}
						},
					},
				],
			},
			{
				reload: true,
			}
		),
	],
};
