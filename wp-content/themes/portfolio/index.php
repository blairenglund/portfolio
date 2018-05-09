<?php
get_header();
?>
<div id="app" class="bg-dark-gray">
	<div class="skipLinks avenir pv3" tabindex="0">
		<a class="link white no-underline ph3" href="#about" tabindex="0">About</a>
		<a class="link white no-underline ph3" href="#projects" tabindex="0">Projects</a>
	</div>
	<section class="vh-100 dt w-100 v-mid avenir cover diamond">
		<div class="dtc tc v-mid ph4 relative z-5">
			<hgroup class="ph2 pv1 br4">
				<div class="animated fadeInDown">
					<h1 class="f1 f-headline-l fw2 tracked ttl lh1 mb2 white pearl pearl-text">{{ blogTitle }}</h1>
				</div>
				<h2 class="f3 fw6 washed-green ttu tracked mb5 animated fadeInUp">{{ blogDescription }}</h2>				
			</hgroup>
		</div>
	</section>

	<section id="about" class="vh-100 dt w-100 avenir v-mid pearl">
		<div class="dtc v-mid black-70 ph4 pv4 pv6-l ph6-l mid-gray" v-html="postData.content.rendered"></div>
	</section>

	<section v-if id="projects" class="vh-100 dt w-100 avenir v-mid bg-dark-gray">
		<div class="ph4 pv4 pv6-l ph6-l">
			<div class="mb5">
				<h2 class="f2 tc pearl pearl-text">Recent Work</h2>
			</div>
			<div v-for="project in projects" class="bb pb3 mb5 ">
				<hgroup>
					<a v-if="project.acf.link" v-bind:href="project.acf.link" class="db link" target="_blank" tabindex="0">
						<h3 class="f1 mb1 fw2 tracked washed-green hover-washed-red">{{ project.title.rendered }}</h3>
					</a>
					<h3 v-else class="f1 mb1 fw2 tracked light-gray">{{ project.title.rendered }}</h3>
					<h4 class="f4 light-gray" v-html="project.acf.description"></h4>
				</hgroup>
				<p class="light-gray f5 lh-copy" v-html="project.acf.responsibilities"></p>
			</div>
		</div>
	</section>
</div>


<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			blogTitle: '<?php echo get_bloginfo('name'); ?>',
			blogDescription: '<?php echo get_bloginfo('description'); ?>',
			postData: '',
			projects: '',
		},
		methods: {
            getBlogData() {
                this.$http.get('/wp-json').then(function(response) {
                	console.log(response.body)
                    this.$data.postData = response.body
                }, function(response) {
                    // Error
                    console.log(response);
                });
            },
            getPostData() {
                this.$http.get('/wp-json/wp/v2/pages/<?php the_id('Home'); ?>').then(function(response) {
                	console.log(response.body)
                    this.$data.postData = response.body
                }, function(response) {
                    // Error
                    console.log(response);
                });
            },
            getProjects() {
                this.$http.get('/wp-json/wp/v2/project').then(function(response) {
                	console.log(response.body)
                    this.$data.projects = response.body
                }, function(response) {
                    // Error
                    console.log(response);
                });
            }
        }
	})

	app.getPostData();
	app.getProjects();

</script>

<?php
get_footer();
?>
