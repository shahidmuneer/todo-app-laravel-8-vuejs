<template>
	<div>
		<h2 class="text-center my-4">All lists</h2>
		<Loader v-bind:isLoading="isLoading"></Loader>
		<div class="card my-3" v-for="(list,k) in lists" :key="k">
			<div class="card-body">
				<h5 class="card-title">{{list.name}}</h5>
				<p class="card-text">{{list.description.substring(0,100)}}...</p>
				<!-- <p class="card-text">{{list.status==1?"Completed":"incomplete"}}</p> -->
				<router-link :to="{name: 'lists.show',params:{id: list.id}}" class="btn btn-outline-secondary right">View</router-link>
			</div>
		</div>
		<!-- Pagination Start -->
	    <nav aria-label="Page navigation">
	        <ul class="pagination justify-content-center">
	        	<li class="page-item" v-bind:class="{disabled: !pagination.prevPageUrl}">
		        	<a class="page-link" aria-label="Previous" @click="getlists(pagination.prevPageUrl)">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		            </a>
	        	</li>
	        	<li class="page-item">
	        		<a class="page-link disabled">Page {{pagination.currentPage}} of {{pagination.total}}</a>
	        	</li>
	        	<li class="page-item" v-bind:class="{disabled: !pagination.nextPageUrl}">
	        		<a class="page-link" @click="getlists(pagination.nextPageUrl)">
	        			<span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Next</span>
	        		</a>
	        	</li>
	        </ul>
	    </nav>
	</div>
</template>

<script>
	import Loader from '../includes/Loader'
	export default {
		components: {
			Loader
		},
		created: function() {
			this.getlists()
		},
		data() {
			return {
				lists: [],
				pagination: {
					currentPage: 1,
					prevPageUrl: '',
					nextPageUrl: '',
					lastPage: 1
				},
				isLoading: false
			}
		},
		methods: {
			getlists(paginationUrl){
				this.isLoading = true
				const url = paginationUrl || '/api/lists'
				axios.get(url)
					.then(res => {
						this.isLoading = false
						// console.log(res.data)
						let lists = res.data.lists
						this.lists = lists.data
						this.paginate(lists)
					})
					.catch(err => {
						console.error(err)
						this.isLoading = false
						this.flashError('Something went wrong! Refresh the page to load lists again.')
					})
			},
			paginate(meta){
				this.pagination.currentPage = meta.current_page
				this.pagination.prevPageUrl = meta.prev_page_url
				this.pagination.nextPageUrl = meta.next_page_url
				this.pagination.total = meta.last_page
			}
		}
	}
</script>