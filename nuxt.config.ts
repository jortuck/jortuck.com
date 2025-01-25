// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";
export default defineNuxtConfig({
	devtools: { enabled: true },
	modules: ["@nuxt/content"],
	vite: {
		plugins: [tailwindcss()],
		build: {
			minify: false
		}
	},
	css: ["/assets/css/app.css"],
	runtimeConfig: {
		public: {
			turnstileKey: ""
		},
		turnstileSecret: "",
		awsAccessKeyId: "",
		awsSecretAccessKey: "",
		mailDestination: "",
		discordWebhook: ""
	},
	// routeRules:{
	// 	'/projects/*':{prerender:true},
	// 	'/projects':{prerender:true},
	// 	'/':{prerender:true}
	// },
	app: {
		pageTransition: {
			name: "page",
			mode: "out-in"
		},
		head: {
			link: [{ rel: "icon", href: "/favicon.webp" }],
			htmlAttrs: {
				lang: "en"
			},
			script: [{ src: "https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" }]
		}
	},

	compatibilityDate: "2024-10-16"
});
