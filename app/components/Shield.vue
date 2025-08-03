<script setup lang="ts">
defineProps({
	text: String,
	logo: String,
	logoColor: String,
	badgeColor: String,
})
</script>/
<template>
	<img
	alt="Static Badge saying {text}"
	class="my-1 rounded-md"
	:src="`https://shields.driedsponge.net/badge/${text}-${badgeColor}?logo=${logo}&logoColor=${logoColor}&style=for-the-badge`"
/>
</template>