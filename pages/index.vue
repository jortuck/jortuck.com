<script setup lang="ts">
import Shield from "~/components/Shield.vue";
import { ZodError, type ZodErrorMap, type ZodIssue, ZodSchema } from "zod";
import { schema } from "~/shared/ContactFormScheme";
import { $fetch, FetchError } from "ofetch";

const config = useRuntimeConfig();
useSeoMeta({
	title: "Home | Jordan Tucker",
	ogTitle: "Home | Jordan Tucker",
	description:
		"Hello, my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogDescription:
		"Hello , my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogUrl: "https://jortuck.com"
});
let { data } = await useAsyncData("featuredProjects", () =>
	queryContent("/projects")
		.where({ title: { $in: ["Paleoclimate Visualizer", "Freddy Bot"] } })
		.find()
);
let contactForm = ref({
	name: "",
	email: "",
	subject: "",
	message: "",
	cftoken: ""
});
type Errors = {
	name: string;
	email: string;
	subject: string;
	message: string;
	cftoken: string;
};
let errors = ref<Errors>({
	name: "",
	email: "",
	subject: "",
	message: "",
	cftoken: ""
});
let turnstileId = ref("");
let formError = ref("");
let formSuccess = ref(false);
let loading = ref(false);
onMounted(() => {
	//@ts-ignore
	window.turnstile.ready(function () {
		// @ts-ignore
		turnstileId = window.turnstile.render(".cf-turnstile", {
			sitekey: config.public.turnstileKey,
			callback: function (token: string) {
				console.log(`Challenge Success ${token}`);
				contactForm.value.cftoken = token;
			},
			"error-callback": function () {
				errors.value.cftoken =
					"Unfortunately, it looks like you have been detected as a bot. Please refresh the page.";
			}
		});
	});
});

function validate(schema: ZodSchema, data: object, field: keyof Errors) {
	let result = schema.safeParse(data);
	if (!result.success) {
		errors.value[field] = result.error.issues[0].message;
		console.log(result.error.issues[0]);
	} else {
		errors.value[field] = "";
	}
}

const isErrors = computed(() => {
	let result: boolean = false;
	Object.keys(errors.value).forEach((key: string) => {
		if (errors.value[key as keyof Errors] != "") {
			result = true;
		}
	});
	return result;
});

async function handleSubmit() {
	loading.value = true;
	let response = await $fetch("/api/contact", {
		method: "POST",
		body: contactForm.value,
		onResponse: () => {
			loading.value = false;
		}
	}).catch((error: FetchError) => {
		if (error.status == 400) {
			error.data.forEach((element: ZodIssue) => {
				errors.value[element.path[0] as keyof Errors] = element.message;
			});
		} else if (error.status == 403) {
			errors.value["cftoken" as keyof Errors] = error.data.message;
		} else {
			formError.value =
				"An internal error occured on my end. Please reach out using LinkedIn or try again later.";
			// @ts-ignore
			window.turnstile.reset(turnstileId);
		}
	});
	if (response) {
		if (response.success) {
			formSuccess.value = true;
			formError.value = "";
			// @ts-ignore
			window.turnstile.reset(turnstileId);
		}
	}
}
</script>
<template>
	<div class="space-y-20">
		<section class="mt-20 w-full text-center md:mt-28 md:space-y-6 lg:mt-40 lg:text-left">
			<div
				class="h-full space-y-9 bg-gradient-to-br from-white via-primary to-white to-70% bg-clip-text tracking-tighter text-transparent lg:space-y-6 lg:pr-10"
			>
				<h1 class="text-5xl font-semibold tracking-tighter select-none lg:text-7xl xl:text-8xl">
					Hi, I'm Jordan.
				</h1>
				<h2 class="text-4xl font-semibold tracking-tighter select-none sm:h-auto xl:text-6xl">
					I'm an Informatics student at the University of Washington.
				</h2>
				<div class="space-x-6 text-5xl">
					<a
						target="_blank"
						class="social-link"
						href="https://github.com/jortuck"
						title="Github"
					>
						<i class="fa-brands fa-github"></i>
					</a>
					<a
						target="_blank"
						class="social-link"
						href="https://linkedin.com/in/jortuck"
						title="Linked In"
					>
						<i class="fa-brands fa-linkedin"></i>
					</a>
				</div>
			</div>
		</section>
		<section class="space-y-12">
			<div class="space-y-8">
				<ProseH2>About</ProseH2>
				<ProseP>
					My name is Jordan, I'm a student studying
					<NuxtLink
						class="text-primary hover:underline"
						external
						target="_blank"
						to="https://ischool.uw.edu/programs/informatics"
						>Informatics
					</NuxtLink>
					at the
					<NuxtLink
						to="https://washington.edu"
						external
						target="_blank"
						>University of Washington.
					</NuxtLink>
					I have been teaching myself to program since 2019, and have focused my efforts in web
					development, server-side applications, and data science applications. My most recent
					project involved working at the University of Washington's
					<NuxtLink
						class="text-primary hover:underline"
						to="https://ocean.washington.edu"
						external
						target="_blank"
					>
						School of Oceanography
					</NuxtLink>
					as a research assistant, building an interactive web application for the visualization of
					paleoclimate data reconstructions. You can check it out at
					<NuxtLink
						class="text-primary hover:underline"
						to="https://pv.jortuck.com"
						external
						target="_blank"
					>
						https://pv.jortuck.com
					</NuxtLink>
					.
				</ProseP>
			</div>
			<div class="space-y-6">
				<ProseH2> Experience </ProseH2>
				<ProseH3>Work</ProseH3>
				<div class="my-3 grid grid-cols-1 gap-3">
					<ContentList
						path="/work"
						slot="item"
						v-slot="{ list }"
					>
						<div
							v-for="item in list"
							class="flex flex-col space-y-4 rounded-md border-2 border-base-200 bg-gradient-to-br from-base-150 to-base-100 p-3"
						>
							<div class="flex-1 space-y-2 text-gray-50">
								<div>
									<h4 class="text-lg font-bold md:text-xl">
										{{ item.title }}
									</h4>
									<h5>{{ item.date }}</h5>
									<h5 class="italic">{{ item.company }}, {{ item.location }}</h5>
								</div>
								<div>
									<p v-if="item.description">{{ item.description }}</p>
									<ul
										v-if="item.bullets"
										class="list-inside list-disc"
									>
										<li v-for="bullet in item.bullets">{{ bullet }}</li>
									</ul>
								</div>
							</div>
							<div class="flex flex-wrap gap-2 text-gray-50">
								<NuxtLink
									v-for="link in item.links"
									:to="link.href"
									class="block w-fit space-x-2.5 rounded-md bg-base-200 px-2 py-1 text-sm select-none hover:bg-base-300"
								>
									{{ link.text }} <i class="fa-solid fa-arrow-right"></i>
								</NuxtLink>
								<span
									v-for="skill in item.skills"
									class="block w-fit space-x-2.5 rounded-md bg-base-200 px-2 py-1 text-sm select-none"
								>
									{{ skill }}
								</span>
							</div>
						</div>
					</ContentList>
				</div>
				<ProseH3>Education</ProseH3>
				<div class="flex flex-col md:flex-row">
					<div
						class="flex items-center justify-center rounded-t-md bg-gradient-to-br from-husky to-husky2 py-10 align-middle md:w-2/3 md:rounded-l-md md:rounded-tr-none"
					>
						<img
							class="block w-fit px-12 py-6"
							alt="University of Washington."
							src="~/assets/images/ischool.png"
						/>
					</div>
					<div
						class="w-full rounded-b-md border-r-2 border-b-2 border-l-2 border-base-200 bg-gradient-to-br from-base-150 to-base-100 md:rounded-r-md md:rounded-b-none md:border-t-2 md:border-l-0"
					>
						<div class="m-3 space-y-2 text-gray-50">
							<h4 class="text-lg font-bold md:text-xl">
								Bachelor of Science - Informatics, Expected June 2027
							</h4>
							<ul class="list-inside list-disc">
								<li>Minor in Mathematics.</li>
								<li>Member of the Husky Marching Band.</li>
								<li>Deans List Recipient: Autumn 2023, Winter 2024, Spring 2024, Autumn 2024.</li>
							</ul>
						</div>
					</div>
				</div>
				<ProseH3>Featured Projects</ProseH3>
				<!--				<ProseP-->
				<!--					>Over time, I have developed my skills many areas of computing including web development,-->
				<!--					server side applications, data science applications, and cloud/computing infrastructure.-->
				<!--				</ProseP>-->
				<div class="my-3 grid grid-cols-1 gap-3 md:grid-cols-2">
					<ProjectCard
						v-for="item in data"
						:title="item.title"
						:description="item.description"
						:github="item.github"
						:link="item._path"
					/>
				</div>
				<NuxtLink
					to="/projects"
					class="block w-fit rounded-md bg-base-200 p-3 text-white hover:bg-base-300"
					>View All Projects <i class="fa-solid fa-arrow-right"></i
				></NuxtLink>
			</div>
			<div class="space-y-4">
				<ProseH2 id="contact"> Contact </ProseH2>
				<ProseP>
					Fill out this form to send a message directly to my inbox! No matter what you have to say,
					I would love to hear from you! You can also reach me on LinkedIn if that's your preferred
					method of communication, my username is
					<ProseA
						href="https://linkedin.com/in/jortuck"
						target="_blank"
						>jortuck</ProseA
					>
					.
				</ProseP>
				<ProseP v-if="formError">
					<span class="font-bold text-red-400">{{ formError }}</span>
				</ProseP>
				<div class="flex w-full flex-row items-center justify-center">
					<form
						@submit.prevent="handleSubmit"
						class="relative my-6 flex w-full flex-col space-y-5 rounded-md"
						:class="{ 'animate-pulse': loading }"
					>
						<Transition>
							<div
								v-if="formSuccess"
								class="bg-opacity-75 absolute flex h-full w-full flex-col items-center justify-center space-y-10 rounded-md border-2 border-base-300 bg-base-100 text-center font-bold backdrop-blur-2xl"
							>
								<h1 class="text-5xl text-green-500">Success!</h1>
								<ProseP class="m-4"
									>Your message was successfully sent. I will do my best to get back to you within
									24 hours.
								</ProseP>
								<button
									@click="
										() => {
											formSuccess = false;
											contactForm = {
												name: '',
												email: '',
												subject: '',
												message: '',
												cftoken: contactForm.cftoken
											};
										}
									"
									type="reset"
									class="rounded-md bg-base-200 p-3 text-white transition-colors duration-200 hover:bg-base-300"
								>
									Submit Another Response
								</button>
							</div>
						</Transition>
						<div class="flex w-full flex-col space-y-5 md:flex-row md:space-y-0 md:space-x-4">
							<label
								>Name*
								<input
									v-model="contactForm.name"
									name="name"
									type="text"
									placeholder="Chris P. Bacon"
									:class="{ error: errors['name'] }"
									maxlength="50"
									:disabled="loading"
									@focusout="
										() => {
											validate(schema.pick({ name: true }), { name: contactForm.name }, 'name');
										}
									"
								/>
								<span class="error">{{ errors["name"] }}</span>
							</label>
							<label
								>Email*
								<input
									v-model="contactForm.email"
									name="email"
									type="email"
									placeholder="email@example.com"
									:class="{ error: errors['email'] }"
									maxlength="50"
									:disabled="loading"
									@focusout="
										() => {
											validate(schema.pick({ email: true }), { email: contactForm.email }, 'email');
										}
									"
								/>
								<span class="error">{{ errors["email"] }}</span>
							</label>
						</div>
						<div class="space-y-5">
							<label
								>Subject (required)
								<input
									v-model="contactForm.subject"
									placeholder="A nice message."
									name="subject"
									type="text"
									:class="{ error: errors['subject'] }"
									maxlength="50"
									:disabled="loading"
									@focusout="
										() => {
											validate(
												schema.pick({ subject: true }),
												{ subject: contactForm.subject },
												'subject'
											);
										}
									"
								/>
								<span class="error">{{ errors["subject"] }}</span>
							</label>
							<label
								>Message*
								<textarea
									v-model="contactForm.message"
									name="message"
									:disabled="loading"
									rows="4"
									maxlength="1000"
									@focusout="
										() => {
											validate(
												schema.pick({ message: true }),
												{ message: contactForm.message },
												'message'
											);
										}
									"
									:class="{ error: errors['message'] }"
									placeholder="Had a slight weapons malfunction but, uh everything’s perfectly all right now. We’re fine. We’re all fine here now. Thank you. How are you?"
								></textarea>
								<span class="error">{{ errors["message"] }}</span>
							</label>
						</div>
						<div
							class="flex flex-col content-center items-center space-y-3 md:flex-row md:space-y-0 md:space-x-3"
						>
							<div class="cf-turnstile"></div>
							<span class="error font-bold">{{ errors["cftoken"] }}</span>
						</div>
						<button
							:disabled="isErrors || loading"
							type="submit"
							class="submit-btn"
						>
							<i class="fa-solid fa-paper-plane"></i> Send
						</button>
					</form>
				</div>
			</div>
		</section>
	</div>
</template>
<style scoped>
@reference "../assets/css/app.css";

.v-enter-active,
.v-leave-active {
	transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
	opacity: 0;
}

.social-link {
	@apply transition-colors duration-200 ease-in-out hover:text-white;
}

input {
	@apply bg-base-200 text-white focus:border-primary focus:bg-base-300 active:bg-base-300;
	@apply mt-1 block w-full rounded-md border-2 border-transparent p-2 font-normal transition-colors duration-200 ease-in-out focus:outline-hidden;
}

label {
	@apply block w-full font-bold text-white;
}

input.error,
textarea.error {
	@apply border-2 border-red-400;
}

label > span.error {
	@apply text-sm font-normal;
}

span.error {
	@apply text-red-400;
}

.submit-btn {
	@apply text-white hover:bg-primary disabled:hover:bg-base-200;
	@apply block rounded-md bg-base-200 p-3 transition-colors duration-200 ease-in-out disabled:hover:cursor-not-allowed;
}

textarea {
	@apply bg-base-200 text-white focus:border-primary focus:bg-base-300 active:bg-base-300;
	@apply mt-1 block w-full rounded-md border-2 border-transparent p-2 font-normal transition-colors duration-200 ease-in-out focus:outline-hidden;
}

.small-heading {
	@apply bg-gradient-to-br from-white via-primary to-white bg-clip-text text-2xl font-bold text-transparent md:text-3xl;
}

.section-paragraph {
	@apply text-lg text-gray-200;
}

.section-paragraph > a {
	@apply text-primary hover:underline;
}
</style>
