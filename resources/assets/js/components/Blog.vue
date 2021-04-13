<template>
    <div>
        <!-- START: Blog Section -->
        <div class="container mt-4">
            <div class="card">
                <div class="card-body" v-if="blog">
                    <h2 class="card-title font-weight-bold">{{ blog.title }}</h2>
                    <small class="font-weight-bold text-uppercase text-info pr-2" v-if="blog.author">{{ blog.author.name }}</small> |
                    <small class="pl-2">{{ blog.created_at }}</small>
                    <div
                        v-html="blog.body"
                        class="card-text pt-4">
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Blog Section -->
        <hr>
        <!-- START: Comment Form -->
        <section>
            <h5 class="font-weight-bold">Add Comment</h5>
            <AddCommentForm
                :blogId="blogId"
                @fetch-comments="refreshComments" />
        </section>
        <!-- END: Comment Form -->
        <hr>
        <!-- START: Comments Section -->
        <div class="container">
            <ListComments :blogId="blog.id" :key="componentKey"/>
        </div>
        <!-- END: Comments Section -->

    </div>
</template>

<script>
import AddCommentForm from './AddCommentForm.vue';
import ListComments from './ListComments.vue';

export default {
    name: 'Blog',

    components: {
        AddCommentForm,
        ListComments
    },

    data() {
        return {
            blog: {},
            blogId: 1,
            componentKey: 0
        }
    },

    created() {
        this.fetchBlog();
    },

    methods: {
        fetchBlog() {
            const url = `/api/blogs/${this.blogId}`;
            // const response = await fetch(url);
            // this.blog = await response.json();
            axios.get(url)
                .then((response) => {
                    this.blog = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        refreshComments() {
            this.componentKey += 1;
        }
    }
}
</script>

<style>
.article-title {
    text-align: center;
}

article {
  text-align: justify;
}
</style>