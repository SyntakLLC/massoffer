<template>
    <Head><title>Offer for your home</title></Head>

    <header class="bg-[#0963ac] py-4 px-6">
            <img
                class="h-12 w-auto rounded-lg mx-auto"
                src="https://i.imgur.com/maCKpBh.png"
                alt="Mass Offer Logo" />
    </header>

<!--    <img src="https://images.unsplash.com/photo-1601082100496-2b63c50ad41c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTY4fHxyZWFsJTIwZXN0YXRlJTIwaW50ZXJpb3J8ZW58MHx8MHx8&auto=format&fit=crop&w=900&q=60"-->
    <img src="https://i.imgur.com/iViRi3z.png"
         alt="Real estate interior decorative photo"
         class="fixed w-screen h-screen object-cover" />
<!--    <div class="fixed w-screen h-screen bg-black opacity-50"/>-->


    <flow-form
        @submit="submit"
        :questions="questions"
        :language="language">
<!--        <template #-->
    </flow-form>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import { FlowForm, QuestionModel, QuestionType, ChoiceOption, LanguageModel } from '@ditdot-dev/vue-flow-form'

export default {
    name: 'Welcome',

    components: {
        Head,
        FlowForm,
    },

    setup() {
        const questionKeys = [
            'welcome',
            'name',
            'email',
            'propertyType',
            'estimatedWorth',
            'timeline',
            'bedroomCount',
            'bathroomCount',
            'shouldReceiveOffer',
        ];
        return { questionKeys };
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
                    required: true,
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
                    required: true,
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
                    required: true,
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
                    required: true,
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
                    required: true,
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
