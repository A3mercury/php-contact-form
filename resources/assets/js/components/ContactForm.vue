<template>
    <div>
        <h3 v-if="hasContacted"><i class="fa fa-check-circle"></i> Thanks! Mr. Smiley will be in touch soon.</h3>
        <div v-else>
            <h2>Contact Guy Smiley</h2>
            <p>Remember Guy Smiley?  Yeah, he wants to hear from you.</p>
            <p class="bg-primary">
                
                <div class="form-group">
                    <input v-model="contact.full_name" type="text" name="full_name" class="form-control" placeholder="Full Name *">
                    <div class="text-danger text-left" v-if="errors.full_name">
                        <small>{{errors.full_name[0]}}</small>
                    </div>
                </div>

                <div class="form-group">
                    <input v-model="contact.email" type="email" name="email" class="form-control" placeholder="Email *">
                    <div class="text-danger text-left" v-if="errors.email">
                        <small>{{errors.email[0]}}</small>
                    </div>
                </div>

                <div class="form-group">
                    <input v-model="contact.phone" type="text" name="phone" class="form-control" placeholder="Phone">
                    <div class="text-danger text-left" v-if="errors.phone">
                        <small>{{errors.phone[0]}}</small>
                    </div>
                </div>

                <div class="form-group">
                    <textarea v-model="contact.message" name="message" cols="30" rows="10" class="form-control" placeholder="Message *"></textarea>
                    <div class="text-danger text-left" v-if="errors.message">
                        <small>{{errors.message[0]}}</small>
                    </div>
                </div> 

                <div class="form-group">
                    <button class="btn btn-default btn-lg" @click="submitForm()">Send</button>
                </div>

            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                hasContacted: false,
                contact: {
                    full_name: '',
                    email: '',
                    phone: '',
                    message: '',
                },
                errors: {}
            };
        },
        methods: {
            submitForm() {
                axios.post('/contact', {
                    full_name: this.contact.full_name,
                    email: this.contact.email,
                    phone: this.contact.phone,
                    message: this.contact.message,
                })
                    .then((response) => {
                        this.hasContacted = response.data.success;
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>
