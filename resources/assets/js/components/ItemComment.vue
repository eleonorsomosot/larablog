<template>
    <div>
        <div class="card">
            <div class="card-body p-3">

                <!-- START: Main Comment Element -->
                <h6 class="card-title font-weight-bold mb-0">{{ item.user.name }}</h6>
                <small>{{ item.created_at }}</small>
                <div class="row mt-2">
                    <div class="col-md-10 align-self-center">
                        <p v-html="item.content" class="card-text mb-2 pre-formatted"></p>
                    </div>
                    <div class="col-md-2 text-right align-self-end">
                        <button
                            class="btn btn-sm px-3"
                            :class="{ 'btn-dark': !showReplyForm, 'btn-outline-danger': showReplyForm }"
                            @click="toggleCommentForm">{{ replyBtnText }}
                        </button>
                    </div>
                </div>
                <!-- END: Main Comment Element -->

                <!-- START: Comment Form -->
                <div id="comment-form" class="container-fluid mt-3" v-show="showReplyForm">
                    <AddCommentForm
                        :blogId="blogId"
                        :commentId="item.id"
                        @fetch-comments="$emit('fetch-comments')"
                        @close-form="toggleCommentForm" />
                </div>
                <!-- END: Comment Form -->

                <!-- START: Comment Replies -->
                <div class="container-fluid pr-0" v-if="item.replies && item.replies.length">
                    <div v-for="reply in item.replies" :key="reply.id">
                        <ItemComment
                            :item="reply"
                            :blogId="blogId"
                            class="mt-3"
                            @fetch-comments="$emit('fetch-comments')" />
                    </div>
                </div>
                <!-- END: Comment Replies -->

            </div>
        </div>
    </div>
</template>

<script>
import AddCommentForm from './AddCommentForm.vue';

export default {
    name: 'ItemComment',

    components: {
        AddCommentForm
    },

    props: {
        item: Object,
        blogId: Number
    },

    data() {
        return {
            showReplyForm: false,
            replyBtnText: 'Reply',
            componentKey: 0
        }
    },

    methods: {
        toggleCommentForm() {
            this.showReplyForm = !this.showReplyForm;
            this.replyBtnText = this.showReplyForm ? 'Close' : 'Reply';
        }
    }
}
</script>

<style scoped>
div#comment-form {
    text-align: right;
}
.pre-formatted {
  white-space: pre;
}
</style>