import SftpClient from 'ssh2-sftp-client';
import { env } from './env.js';

export const assetsDeployGlobs = [ 'assets/**/*.*' ];

// Полный деплой (build / deploy:ftp). PHP и шаблоны — через .vscode/sftp.json в dev.
export const deployGlobs = [
	...assetsDeployGlobs,
	'functionality/**/*.*',
	'components/**/*.*',
	'widget/**/*.*',
	'*.php',
	'style.css',
	'screenshot.png',
];

export function isFtpConfigured() {
	return Boolean( env.FTP_HOST && env.FTP_USER && env.FTP_PASSWORD );
}

export async function createSftpConnection() {
	if ( ! isFtpConfigured() ) {
		return null;
	}

	const sftp = new SftpClient();
	await sftp.connect( {
		host: env.FTP_HOST,
		port: env.FTP_PORT,
		username: env.FTP_USER,
		password: env.FTP_PASSWORD,
		readyTimeout: 30_000,
	} );
	return sftp;
}

export { env as ftpEnv };
