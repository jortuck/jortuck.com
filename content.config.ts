import { defineCollection, defineContentConfig, z } from "@nuxt/content";

export default defineContentConfig({
	collections: {
		work: defineCollection({
			source: "work/**.json",
			type: "data",
			schema: z.object({
				title: z.string(),
				bullets: z.array(z.string()),
				date: z.string(),

				location: z.string(),
				company: z.string(),
				links: z.array(
					z.object({
						text: z.string(),
						href: z.string()
					})
				),
				skills: z.array(z.string())
			})
		}),
		projects: defineCollection({
			source: "projects/*.md",
			type: "page",
			schema: z.object({
				title: z.string(),
				description: z.string(),
				github: z.string().optional(),
				image: z.object({
					src: z.string().url(),
					type: z.string()
				})
			})
		})
	}
});
