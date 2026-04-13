<template>
	<div class="my-6 flex flex-col md:flex-row items-start rounded-r-lg border-l-4 border-primary bg-primary/10 p-4">
		<div class="mr-3 mt-0.5 shrink-0 text-primary">
			<i :class="icon" class="text-xl"></i>
		</div>

		<div class="prose prose-sm sm:prose-base max-w-none text-gray-800 dark:prose-invert dark:text-gray-200">
			<slot mdc-unwrap="p" />
		</div>
	</div>
</template>
<script setup>
defineProps({
	icon: {
		type: String,
		default: 'fa-solid fa-circle-info'
	}
})
</script>