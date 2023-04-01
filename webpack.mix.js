

mix.disableNotifications();

if (mix.inProduction()) {
	mix.version();

	const ASSET_URL = process.env.ASSET_URL + '/';

	mix.webpackConfig((webpack) => {
		return {
			plugins: [
				new webpack.DefinePlugin({
					'process.env.ASSET_PATH': JSON.stringify(ASSET_URL),
				}),
			],
			output: {
				publicPath: ASSET_URL,
			},
		};
	});
} else {
	mix.sourceMaps();

	const domain = 'massoffer.test'; // <= EDIT THIS
	const homedir = require('os').homedir();

	// The mix script:
	mix.browserSync({
		proxy: 'https://' + domain,
		host: domain,
		open: 'external',
		https: {
			key: homedir + '/.config/valet/Certificates/' + domain + '.key',
			cert: homedir + '/.config/valet/Certificates/' + domain + '.crt',
		},
		notify: false,
	});
}
