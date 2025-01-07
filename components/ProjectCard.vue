<script setup lang="ts">
defineProps({
	link: String,
	title: String,
	description: String,
	github: String
});
</script>
<template>
	<div
		class="duration-400 from-base-150 flex flex-col rounded-md border-2 border-base-200 bg-gradient-to-br to-base-100 transition-colors ease-in-out hover:border-base-300"
	>
		<div class="m-2 flex-1 space-y-2">
			<div class="space-x-2">
				<NuxtLink
					:to="link"
					class="text-xl font-bold text-primary hover:underline md:text-2xl"
				>
					{{ title }}
				</NuxtLink>
			</div>
			<p class="text-white">
				{{ description }}
			</p>
		</div>
		<div class="m-2 space-x-2.5 text-white">
			<NuxtLink
				:to="link"
				class="select-none space-x-2.5 rounded-md bg-base-200 px-2 py-1 text-sm hover:bg-base-300"
			>
				Learn More <i class="fa-solid fa-arrow-right"></i>
			</NuxtLink>
			<NuxtLink
				v-if="github"
				target="_blank"
				external
				:to="`https://github.com/jortuck/${github}`"
				class="select-none space-x-2.5 rounded-md bg-base-200 px-2 py-1 text-sm hover:bg-base-300"
			>
				Source Code <i class="fa-regular fa-arrow-up-right-from-square fa-sm ml-1"></i>
			</NuxtLink>
		</div>
	</div>
</template>
