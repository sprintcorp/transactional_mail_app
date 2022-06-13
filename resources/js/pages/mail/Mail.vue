<template>
    <div class="row mt-4 mb-4">
        <router-link class="text-decoration-none mb-2" to="/">
           <font-awesome-icon icon="arrow-left"/>
        </router-link>
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">Email Information</h5>
                <div class="card-body">
                    <p class="card-text">Subject: {{mail.subject}}</p>
                    <p class="card-text">From: {{mail.sender}}</p>
                    <p class="card-text">To: {{mail.recipient}}</p>
                    <p class="card-text">Status:
                    <span :class="(mail.current_status.status.toLowerCase() ==='sent')
                    ? 'badge text-bg-success':(mail.current_status.status.toLowerCase() ==='failed') ?
                     'badge text-bg-danger': 'badge text-bg-light'">{{ mail.current_status.status }}</span>
                    </p>

                    <a href="#" class="btn btn-primary" v-if="!loading && mail.current_status.status.toLowerCase() === 'failed'" @click="resendMail(mail.id)">Resend</a>
                    <button class="btn btn-primary" v-if="loading" type="button" disabled>
                        Sending...
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    </button>
                    <div class="mt-4">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-text_content-tab" data-bs-toggle="pill" data-bs-target="#pills-text_content" type="button" role="tab" aria-controls="pills-text_content" aria-selected="true">
                                    Text content
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-html_content-tab" data-bs-toggle="pill" data-bs-target="#pills-html_content" type="button" role="tab" aria-controls="pills-html_content" aria-selected="false">
                                    HTML content
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active px-3" id="pills-text_content" role="tabpanel" aria-labelledby="pills-text_content-tab" tabindex="0">
                                <p> {{ mail.text_content }}</p>
                            </div>
                            <div class="tab-pane fade" id="pills-html_content" role="tabpanel" aria-labelledby="pills-html_content-tab" tabindex="0">
                                <div v-html="mail.html_content"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card px-3">
                <div class="stepper d-flex flex-column mt-5">
                    <div class="d-flex mb-2" v-for="(status,index) in mail.status" :key="index">
                        <div class="d-flex flex-column pr-4 align-items-center">
                            <span :class="(status.status.toLowerCase() ==='sent')
                    ? 'badge text-bg-success':(status.status.toLowerCase() ==='failed') ?
                     'badge text-bg-danger': 'badge text-bg-light'">{{ status.status }}</span>
                            <div class="line h-100"></div>
                        </div>
                        <div>
                            <small class="pb-3">{{ status.description }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./Mail.js"></script>

<style lang="css" scoped>
@import "Mail.css";
</style>
