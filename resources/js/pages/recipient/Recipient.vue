<template>
    <div class="row card p-2 m-auto my-3">
    <table v-if="!loading && mail.data && mail.data.length > 0" class="table table-borderless">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Sender</th>
            <th scope="col">Subject</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(mail,index) in mail.data" :key="index">
            <th>
                <input class="form-check-input" type="checkbox" value="" id="">
            </th>
            <td>{{mail.sender  }}</td>
            <td>{{ mail.subject }}</td>
            <td>{{mail.current_status.status}}</td>
            <td><a  class="pointer" @click="viewEmail(mail.id)"><font-awesome-icon icon="eye"/></a></td>
        </tr>
        </tbody>
    </table>

    <LoaderComponent v-if="loading"/>
    </div>
</template>

<script src="./Recipient.js"></script>

<style lang="css" scoped>
@import "Recipient.css";
</style>
