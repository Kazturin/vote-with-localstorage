<template>
    <button @click="share" class="inline-flex items-center m-2 py-1 rounded-full text-sm" title="Share this post to facebook">
		  <span>
			<svg class="w-5 fill-current text-sky-600 hover:text-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
			  <path :d="svgPath"></path>
			</svg>
		  </span>
    </button>
</template>

<script>
import objectToGetParams from '../utils/objectToGetParams';

export default {
    name: "ShareLink",
    props: {
        socialUrl: {
            required: true,
            type: String
        },
        params: {
            required: true,
        
        },
        svgPath: {
            required: false,
            type: String
        }
    },
    methods:{
        share(){
            window.open(
                this.socialUrl+objectToGetParams(this.params),
                '__blank'
            );
        }
    }
}
</script>

<style scoped>

</style>
