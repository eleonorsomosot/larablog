<template>
    <div>
        <!-- START: Comment Form -->
        <!-- <section>
            <h5 class="font-weight-bold">Add Comment</h5>
            <AddCommentForm
                :blogId="blogId"
                @fetch-comments="fetchComments" />
        </section> -->
        <!-- END: Comment Form -->
        <!-- <hr> -->
        <!-- START: Comments List -->
        <h5 class="font-weight-bold">Comments</h5>
        <section class="sec-comments">
            <div
                class="card"
                :key="comment.id"
                v-for="comment in comments">
                <ItemComment
                    :item="comment"
                    :blogId="blogId"
                    @fetch-comments="fetchComments" />
            </div>
        </section>
        <!-- END: Comments List -->
    </div>
</template>

<script>
import AddCommentForm from './AddCommentForm.vue'
import ItemComment from './ItemComment.vue'

export default {
    name: 'ListComments',

    components: {
      AddCommentForm,
      ItemComment
    },

    props: {
        blogId: Number
    },

    data() {
        return {
            comments: [],
            componentKey: 0
        }
    },

    created() {
        this.fetchComments();
    },

    methods: {
        fetchComments() {
            const url = '/api/comments';
            // const response = await fetch(url);
            // this.comments = await response.json();
            axios.get(url)
                .then((response) => {
                    this.comments = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}

</script>