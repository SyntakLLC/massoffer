<template>
    <Head><title>Offer for your home</title></Head>

    <header class="bg-[#0963ac] py-4 px-6">
            <img
                class="h-12 w-auto rounded-lg mx-auto"
                src="https://i.imgur.com/maCKpBh.png"
                alt="Mass Offer Logo" />
    </header>

    <img src="https://i.imgur.com/iViRi3z.png"
         alt="Real estate interior decorative photo"
         class="absolute w-screen h-screen object-cover z-0" />


    <flow-form
        class="z-50"
        @submit="submit"
        :questions="questions"
        :language="language">
    </flow-form>

    <div v-if="isOnWelcome" class="w-screen h-20 absolute bottom-[1/5] bg-[#ffffff70] z-0">
        <MarqueeText class="relative w-full h-full" :duration="30">
            <div class="h-20 flex justify-center space-x-3">
                <img class="h-full pb-3"
                     src="https://i.imgur.com/apJg1jx.png"
                     alt="Logos"/>
            </div>
        </MarqueeText>

        <div class="flex justify-center mx-auto">
            <img class="pt-6 h-20" src="https://i.imgur.com/M5C8Q5R.png" alt="Logos"/>
            <img class="pt-6 h-20" src="https://i.imgur.com/UVlO2C5.png" alt="Logos"/>
        </div>
    </div>

</template>

<script>
import { Head } from '@inertiajs/vue3';
import MarqueeText from 'vue-marquee-text-component'
import { FlowForm, QuestionModel, QuestionType, ChoiceOption, LanguageModel } from '@ditdot-dev/vue-flow-form'

export default {
    name: 'Welcome',

    components: {
        Head,
        FlowForm,
        MarqueeText,
    },

    setup() {
        const questionKeys = [
            'welcome',
            'name',
            'email',
            'phone',
            'propertyType',
            'estimatedWorth',
            'timeline',
            'bedroomCount',
            'bathroomCount',
            'shouldReceiveOffer',
        ];

        const logos = [
            { alt: "Logos", src: "https://i.imgur.com/M5C8Q5R.png" },
            { alt: "Logos", src: "https://i.imgur.com/UVlO2C5.png" }
        ]

        return { questionKeys, logos };
    },

    mounted() {
        // FlowForm defaults to making the begin button say "Continue". This changes
        // that.
        const observer = new MutationObserver((mutations, obs) => {
            const buttons = document.getElementsByClassName('o-btn-action');
            if (!buttons.length) return;
            if (buttons[0].innerText === 'Continue') {
                buttons[0].innerText = 'Get my Offer!';

                // the following ensures we hide the logos after the welcome
                // page.
                buttons[0].onclick = () => {
                    this.isOnWelcome = false;
                };
                document.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.isOnWelcome = false;
                    }
                });
            }
            obs.disconnect();
        });
        observer.observe(document, {
            childList: true,
            subtree: true
        });
    },

    methods: {
        submit(questions) {
            const answers = {};

            questions.forEach((question, index) => {
                if (!question.answer) return;
                answers[this.questionKeys[index]] = question.answer;
            })

            this.$inertia.post(route('fub'), answers);
        }
    },

    data() {
        return {
            isOnWelcome: true,
            language: new LanguageModel({
                // Your language definitions here (optional).
                // You can leave out this prop if you want to use the default definitions.
            }),
            questions: [
                new QuestionModel({
                    title: 'Get an instant offer on your home in 60 seconds!',
                    content: 'We just need a few details in order to accurately generate your instant offer:',
                    type: QuestionType.SectionBreak,
                }),
                new QuestionModel({
                    required: true,
                    title: 'What is your full name?',
                    type: QuestionType.Text,
                }),
                new QuestionModel({
                    required: true,
                    title: 'What is your email?',
                    type: QuestionType.Email,
                }),
                new QuestionModel({
                    required: true,
                    title: 'What is your phone number?',
                    type: QuestionType.Phone,
                }),
                new QuestionModel({
                    title: 'What type of property are you selling?',
                    type: QuestionType.MultipleChoice,
                    options: [
                        new ChoiceOption({
                            label: 'Single Family House'
                        }),
                        new ChoiceOption({
                            label: 'Multi Family House'
                        }),
                        new ChoiceOption({
                            label: 'Townhouse'
                        }),
                        new ChoiceOption({
                            label: 'Condo'
                        }),
                        new ChoiceOption({
                            label: 'Mobile Home'
                        }),
                        new ChoiceOption({
                            label: 'Not sure'
                        }),
                    ]
                }),
                new QuestionModel({
                    title: 'How much do you think it is worth?',
                    type: QuestionType.MultipleChoice,
                    options: [
                        new ChoiceOption({
                            label: 'Less than $100,000'
                        }),
                        new ChoiceOption({
                            label: '$100,000-$250,000'
                        }),
                        new ChoiceOption({
                            label: '$250,000-$500,000'
                        }),
                        new ChoiceOption({
                            label: '$500,000-$1,000,000'
                        }),
                        new ChoiceOption({
                            label: 'More than $1,000,000'
                        }),
                        new ChoiceOption({
                            label: 'Not sure'
                        }),
                    ]
                }),
                new QuestionModel({
                    title: 'How soon are you looking to sell?',
                    type: QuestionType.MultipleChoice,
                    options: [
                        new ChoiceOption({
                            label: 'As soon as possible'
                        }),
                        new ChoiceOption({
                            label: '1-3 months'
                        }),
                        new ChoiceOption({
                            label: '3-6 months'
                        }),
                        new ChoiceOption({
                            label: '6-12 months'
                        }),
                        new ChoiceOption({
                            label: '12+ months'
                        }),
                        new ChoiceOption({
                            label: 'Not sure'
                        }),
                    ]
                }),
                new QuestionModel({
                    title: 'How many bedrooms are there?',
                    type: QuestionType.MultipleChoice,
                    options: [
                        new ChoiceOption({
                            label: '1'
                        }),
                        new ChoiceOption({
                            label: '2'
                        }),
                        new ChoiceOption({
                            label: '3'
                        }),
                        new ChoiceOption({
                            label: '4'
                        }),
                        new ChoiceOption({
                            label: '5+'
                        }),
                        new ChoiceOption({
                            label: 'Not sure'
                        }),
                    ]
                }),
                new QuestionModel({
                    title: 'How many bathrooms are there?',
                    type: QuestionType.MultipleChoice,
                    options: [
                        new ChoiceOption({
                            label: '1'
                        }),
                        new ChoiceOption({
                            label: '2'
                        }),
                        new ChoiceOption({
                            label: '3'
                        }),
                        new ChoiceOption({
                            label: '4'
                        }),
                        new ChoiceOption({
                            label: '5+'
                        }),
                        new ChoiceOption({
                            label: 'Not sure'
                        }),
                    ]
                }),
                new QuestionModel({
                    title: 'Would you like to receive a no-obligation offer for your house?',
                    type: QuestionType.MultipleChoice,
                    options: [
                        new ChoiceOption({
                            label: 'Yes'
                        }),
                        new ChoiceOption({
                            label: 'No'
                        }),
                    ]
                }),
            ]
        }
    }
}
</script>
