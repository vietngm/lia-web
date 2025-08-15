"use strict";

const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

module.exports = {
	mode: process.env.NODE_ENV === "production" ? "production" : "development",

	entry:
		process.env.NODE_ENV === "plugin"
			? [
					path.resolve(__dirname, "./src/scripts/sync-data.js"),
					path.resolve(__dirname, "./src/scss/plugin.scss"),
			  ]
			: [
					path.resolve(__dirname, "./src/scripts/common.js"),
					path.resolve(__dirname, "./src/scss/common.scss"),
			  ],
	output:
		process.env.NODE_ENV === "plugin"
			? {
					path: path.resolve(
						__dirname,
						"../dist/wp-content/plugins/sync-data/"
					),
					filename: "js/sync-data.js",
			  }
			: {
					path: path.resolve(
						__dirname,
						"../dist/wp-content/themes/liaSpeed/assets/"
					),
					filename: "js/common.js",
			  },
	devtool: process.env.NODE_ENV === "production" ? false : "source-map",

	resolve: {
		extensions: [".ts", ".tsx", ".js", ".scss", ".css"],
		alias: {
			jquery: path.join(__dirname, "node_modules/jquery/src/jquery"),
		},
	},

	module: {
		rules: [
			// JS: babel-loader
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
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
			},

			// Expose jQuery toàn cục
			{
				test: require.resolve("jquery"),
				use: [
					{
						loader: "expose-loader",
						options: {
							exposes: ["$", "jQuery"],
						},
					},
				],
			},

			// SCSS -> CSS
			{
				test: /\.(scss|sass)$/,
				use: [
					MiniCssExtractPlugin.loader, // tách css ra file riêng
					{
						loader: "css-loader", // xử lý import url() trong css
						options: { sourceMap: false },
					},
					{
						loader: "postcss-loader", // autoprefixer, cssnano...
						options: {
							postcssOptions: {
								plugins: [
									require("autoprefixer"),
									...(process.env.NODE_ENV === "production"
										? [require("cssnano")]
										: []),
								],
							},
							sourceMap: false,
						},
					},
					{
						loader: "sass-loader", // biên dịch scss sang css
						options: { sourceMap: false },
					},
					{
						loader: "sass-resources-loader", // chia sẻ biến, mixin
						options: {
							resources: [
								path.resolve(__dirname, "./src/scss/_variable.scss"),
								// Thêm các file chung nếu cần
							],
						},
					},
				],
			},

			// CSS thuần (nếu có import .css riêng)
			{
				test: /\.css$/,
				use: [MiniCssExtractPlugin.loader, "css-loader"],
			},

			// Fonts, images
			{
				test: /\.(svg|eot|woff|woff2|ttf|png|jpe?g|gif)$/,
				type: "asset/resource",
				generator: {
					filename: "images/[name][ext][query]",
				},
			},
			{
				test: /\.(woff2?|eot|ttf|otf)$/,
				type: "asset/resource",
				generator: {
					filename: "fonts/[name][ext][query]",
				},
			},
		],
	},

	plugins: [
		new MiniCssExtractPlugin({
			filename: "css/[name].css",
		}),

		// Chỉ dùng BrowserSync khi dev mode (tùy bạn muốn)
		...(process.env.NODE_ENV !== "production"
			? [
					new BrowserSyncPlugin(
						{
							host: "localhost",
							port: 3002,
							proxy: "liaspeed:8888",
							open: false,
							files: [
								{
									match: [
										"../dist/**/*.css",
										"../dist/**/*.js",
										"../dist/**/*.php",
									],
									fn: (event, file) => {
										if (event === "change") {
											const bs =
												require("browser-sync").get("bs-webpack-plugin");
											if (["js", "php"].includes(file.split(".").pop())) {
												bs.reload();
											} else {
												bs.reload("*.css");
											}
										}
									},
								},
							],
						},
						{ reload: true }
					),
			  ]
			: []),
	],
};
