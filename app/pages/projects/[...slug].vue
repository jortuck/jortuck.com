<script setup lang="ts">
const route = useRoute();
const { data: page } = await useAsyncData(route.path, () => {
	return queryCollection("projects").path(route.path).first();
});
if (page.value) {
	useSeoMeta({
		title: page.value?.title + " | Jordan Tucker",
		description: page.value?.description
	});
} else {
	useSeoMeta({
		title: "Project Not Found"
	});
}
</script>
<template>
	<section class="my-10 space-y-4">
		<NuxtLink
			href="/"
			class="block rounded-md text-white hover:underline md:text-lg"
			><i class="fa-solid fa-arrow-left"></i> Back Home</NuxtLink
		>
		<ContentRenderer
			v-if="page"
			:value="page"
			class="space-y-4"
		>
		</ContentRenderer>
		<div
			v-else
			class="flex w-full flex-col items-center space-y-10 pt-10"
		>
			<h1 class="text-center text-3xl font-bold text-white md:text-5xl">Project Not Found</h1>
			<NuxtLink
				to="/"
				class="block w-fit rounded-md bg-base-200 p-3 text-white hover:bg-base-300"
				><i class="fa-solid fa-arrow-left"></i> Back Home</NuxtLink
			>
		</div>
	</section>
</template>
