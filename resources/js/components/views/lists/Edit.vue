<template>	
	<div>
		<h3 class="text-center my-4">Update list</h3>
		<form v-on:submit.prevent="updateTodo">
			<div class="form-group">
				<label for="name">list Name</label>
				<input type="text" class="form-control" v-bind:class="{'is-invalid': errors.name.length}" v-model="list.name" id="name" placeholder="Enter list Name">
				<div class="invalid-feedback" v-for="(error,key) in errors.name" :key="key">{{error}}</div>
			</div>
			<div class="form-group">
				<label for="description">list Description</label>
				<textarea class="form-control" id="description" v-bind:class="{'is-invalid': errors.description.length}" v-model="list.description" placeholder="Enter Description"></textarea>
				<div class="invalid-feedback" v-for="(error,key) in errors.description" :key="key">{{error}}</div>
			</div>

			<!-- <div class="form-group">
				<label for="description">Completed
				<input type="checkbox" value="1" v-model="list.status" id="status" >
				</label>
				<div class="invalid-feedback" v-for="(error,key) in errors.completed" :key="key">{{completetd}}</div>
			</div> -->
			<button type="submit" class="btn btn-outline-primary">Update list</button>
		</form>
	</div>
</template>

<script>
	export default {
		created: function(){
			const id = this.$route.params.id
			this.getTodo(id)
		},
		data() {
			return {
				list: {
					id: 0,
					name: '',
					description: ''
				},

				//validation errors
				errors: {
					name: [],
					description: []
				},

				msg: ''
			}
		},
		methods: {
			getTodo(id){
				axios
					.get(`/api/lists/${id}`)
					.then(res => {
						const list = res.data.list
						this.list.id = list.id
						this.list.name = list.name
						this.list.description = list.description
						// this.list.status = list.status
					})
					.catch(err => console.log(err))
			},
			updateTodo(){
				axios
					.put(`/api/list/${this.list.id}`,{
						name: this.list.name,
						description: this.list.description,
						// status:this.list.status
					})
					.then(res => {
						// console.log(res)
						if(res.status == 200){
							this.flashSuccess('list Updated!')
							this.$router.push(`/lists/${this.list.id}`)	
						}
						
					})
					.catch(err => {
						console.log(err.response)
						if(err.response.status == 422){
							const errors = err.response.data.errors
							this.errors.name = errors.name || []
							this.errors.description = errors.description || []
						}
					})
			}
		}
	}
</script>