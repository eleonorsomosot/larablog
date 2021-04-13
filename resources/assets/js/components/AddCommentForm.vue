<template>
    <div>
        <div class="form-group">
            <input
                class="form-control"
                v-model.trim="comment.name"
                type="text"
                placeholder="Enter your name" />
            <!-- <datalist id="input-username">
                <option :value="user.id" v-for="user in users" :key="user.id">{{ user.username }}</option>
            </datalist> -->
        </div>
        <div class="form-group">
            <textarea
                class="form-control"
                v-model.trim="comment.content"
                cols="10"
                rows="3"
                placeholder="Express your thoughts here...">
            </textarea>
        </div>
        <div class="form-group btngrp-commentActions">
            <button
                class="btn btn-block btn-primary"
                @click="addComment">Submit
            </button>
        </div>
        <Modal v-if="showModal" @close="showModal = false" :title="modalTitle" :body="modalBody"/>
    </div>
</template>

<script>
import Modal from './Modal.vue';

export default {
    name: 'AddComment',

    components: {
        Modal
    },

    props: {
        blogId: Number,
        commentId: Number
    },

    data() {
        return {
            comment: {},
            users: null,
            showModal: false,
            modalTitle: '',
            modalBody: ''
        }
    },

    created() {
        this.initCommentData();
        this.fetchUsers();
    },

    methods: {
        initCommentData() {
            const parent_id = this.commentId || 0;
            this.comment = {
                content: null,
                blog_id: this.blogId,
                parent_id: parent_id,
                depth: 0,
                name: '',
            };
        },
        fetchUsers() {
            const url = '/api/users';
            // const response = await fetch('/api/users');
            // this.users = await response.json();
            axios.get(url)
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
         async addComment() {
            // let headers = {
            //     method: 'POST',
            //     headers: {
            //         'Accept': 'application/json',
            //         'Content-Type': 'application/json'
            //     }
            // }

            // save user first (every instance of user is assumed new [for now])
            const user = {name: this.comment.name};
            // headers.body = JSON.stringify(user);
            // const userResponse = await fetch('/api/users', headers);
            // const newUser = await userResponse.json();
            let newUser = null;

            await axios.post('/api/users', user)
                .then((response) => {
                    newUser = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });

            if (newUser === null) {
                const err = 'Creating new user failed.';
                this.modalTitle = 'xx ERROR xx';
                this.modalBody = err;
                this.showModal = true;
                console.error(err);
            }

            this.comment.user_id = newUser.id; // set comment user_id to the new user's id
            // headers.body = JSON.stringify(comment); // update post parameters
            // await fetch('/api/comments', headers);
            axios.post('/api/comments', this.comment)
                .then(this.$emit('fetch-comments')) // refresh comment list
                .catch((error) => {
                    const response = error.response;

                    if (response.status === 400) {
                        // TODO: why is this not working??
                        this.modalTitle = 'xx ERROR xx';
                        this.modalBody = response.data.message;
                        this.showModal = true;
                    }

                    console.error({status: response.status, error: response.data.message});
                })
                .finally(() => {
                    this.$emit('close-form');  // close the form nonetheless (for replies)
                    this.initCommentData();
                });

        }
    }
}
</script>

<style scoped>
div.btngrp-commentActions {
    text-align: center;
}
div.btn {
    display: block;
}
</style>