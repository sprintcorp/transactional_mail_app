<template>
    <div>
        <div class="row mb-3 py-5">
            <div class="col-md-2">
                <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Compose <font-awesome-icon icon="plus"/>
                </button>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" v-model="search" @keyup="getMails" placeholder="search sender, recipient, subject">
            </div>
        </div>

        <div class="row card p-2">
            <table v-if="!loading && mails.data && mails.data.length > 0" class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Sender</th>
                    <th scope="col">Recipient</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(mail,index) in mails.data" :key="index">
                    <th>
                        <input class="form-check-input" type="checkbox" value="" id="">
                    </th>
                    <td>{{mail.sender  }}</td>
                    <td><a class="pointer" @click="viewRecipient(mail.recipient)">{{mail.recipient}}</a></td>
                    <td>{{ mail.subject }}</td>
                    <td><span :class="(mail.current_status.status.toLowerCase() ==='sent')
                    ? 'badge text-bg-success':(mail.current_status.status.toLowerCase() ==='failed') ?
                     'badge text-bg-danger': 'badge text-bg-light'">{{ mail.current_status.status }}</span>
                    </td>
                    <td><a  class="pointer" @click="viewEmail(mail.id)"><font-awesome-icon icon="eye"/></a></td>
                </tr>
                </tbody>
            </table>

            <LoaderComponent v-if="loading"/>

<!--            {{mails.data.length}}-->

            <div class="card" v-if="!loading && mails.data && mails.data.length < 1">
                <div class="card-body text-center">
                    No Data Found.
                </div>
            </div>
        </div>

        <div class="row mt-2 text-center">
            <PaginationComponent v-on:paginationChange="paginationChange" :link="mails" :action="getMails"/>
        </div>


        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="staticBackdropLabel">Compose mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="error">
                            <strong v-for="(error,index) in errors" :key="index">{{ error }}<br/></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" v-model="subject" class="form-control" id="subject" placeholder="subject">
                        </div>
                        <div class="mb-3">
                            <label for="senderAddress" class="form-label">Sender address</label>
                            <input type="email" v-model="sender" class="form-control" id="senderAddress" placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="recipientAddress" class="form-label">Recipient address</label>
                            <input type="email" v-model="recipient" class="form-control" id="recipientAddress" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" id="attachment" @change="onChange" class="form-control" multiple>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea v-model="message" class="form-control" id="message" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="htmlContent" class="form-label">HTML Content</label>
                            <textarea v-model="html_content" class="form-control" id="htmlContent" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="sendMail()">Send <font-awesome-icon icon="paper-plane"/></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./Home.js"></script>

<style lang="css" scoped>
@import "Home.css";
</style>
