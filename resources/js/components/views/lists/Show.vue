<template>
	<div class="card my-4">
		<div class="card-body">
			<h3 class="card-title text-center">{{list.name}}</h3>
			<p class="card-text">{{list.description}}</p>
			<!-- <p class="card-text">{{list.status==1?"Completed":"incomplete"}}</p> -->
			<div class="d-flex justify-content-center" v-if="authenticated">
				<router-link :to="{name: 'lists.edit',params: {id: list.id}}" class="btn btn-outline-warning">UPDATE</router-link>
				<button class="btn btn-outline-danger ml-2" @click="deletelist">DELETE</button>
			</div>
		</div>
	</div>
</template>

<script>
	import store from '../../../store/Index'
	import { mapGetters } from 'vuex'
	export default {
		created: function() {
			this.getlist()
		},
		computed:{
			authenticated(){
				return store.getters.isAuthenticated
			}
		},
		data() {
			return {
				list: {
					id: 0,
					name: '',
					description: ''
				}
			}
		},
		methods: {
			getlist(){
				const id = this.$route.params.id;
				axios
					.get(`/api/lists/${id}`)
					.then(res => {
						const list = res.data.list
						this.list.name = list.name
						// this.list.status = list.status
						this.list.description = list.description
						this.list.id = list.id
					})
					.catch(err => console.error(err))
			},
			deletelist(){
				axios
					.delete(`/api/lists/${this.list.id}`)
					.then(res => {
						if(res.status == 200){
							this.flashSuccess(res.data.msg)
							this.$router.push('/lists')
						}
						
					})
					.catch(err => console.log(err))
			}
		}
	}
</script>