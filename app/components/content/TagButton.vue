<script setup lang="ts">
defineProps({
	text: String,
	icon: String,
	url: String,
})
</script>
<template>
	<NuxtLink external target="_blank" :to="url" class="px-3 md:py-3 py-2 bg-base-200 hover:bg-base-300 text-white rounded-md font-bold text-base w-full text-center space-x-1.5">
		<i :class="icon"></i><span>{{text}}</span>
	</NuxtLink>
</template>