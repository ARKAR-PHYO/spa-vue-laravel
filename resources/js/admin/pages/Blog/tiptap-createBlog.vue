<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <button @click="save" class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <p class="">Save</p>
                </button>
            </div>

            <!-- TABLE -->
            <div class="my-6 ">
                <h1 class="block max-w-4xl mx-auto text-4xl"><input type="text" placeholder="Title" class="w-full border-none focus:outline-none"></h1>
                <editor-menu-bar :editor="editor" v-slot="{ commands, isActive, focused }">
                    <div
                        class="menubar is-hidden"
                        :class="{ 'is-focused': focused }"
                    >

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.bold() }"
                        @click="commands.bold"
                        >
                        <i class="fas fa-bold"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.italic() }"
                        @click="commands.italic"
                        >
                        <i class="fas fa-italic"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.strike() }"
                        @click="commands.strike"
                        >
                        <i class="fas fa-strikethrough"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.underline() }"
                        @click="commands.underline"
                        >
                        <i class="fas fa-underline"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.code() }"
                        @click="commands.code"
                        >
                        <i class="fas fa-code"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.paragraph() }"
                        @click="commands.paragraph"
                        >
                        <i class="fas fa-paragraph"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                        @click="commands.heading({ level: 1 })"
                        >
                        H1
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                        @click="commands.heading({ level: 2 })"
                        >
                        H2
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                        @click="commands.heading({ level: 3 })"
                        >
                        H3
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.bullet_list() }"
                        @click="commands.bullet_list"
                        >
                        <i class="fas fa-list-ul"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.ordered_list() }"
                        @click="commands.ordered_list"
                        >
                        <i class="fas fa-list-ol"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.blockquote() }"
                        @click="commands.blockquote"
                        >
                        <i class="fas fa-quote-right"></i>
                        </button>

                        <button
                        class="menubar__button"
                        :class="{ 'is-active': isActive.code_block() }"
                        @click="commands.code_block"
                        >
                        <i class="fas fa-code"></i>
                        </button>

                    </div>
                </editor-menu-bar>
                <editor-content ref="editor" :editor="editor" class="border-none focus:outline-none" />

            </div>
        </div>
    </div>
</template>

<script>
import Icon from './../../shared/Icon'
import EditorIcon from '../../components/EditorIcon'
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import {
    Blockquote,
    BulletList,
    CodeBlock,
    HardBreak,
    Heading,
    ListItem,
    OrderedList,
    TodoItem,
    TodoList,
    Bold,
    Code,
    Italic,
    Link,
    Strike,
    Underline,
    History,
} from 'tiptap-extensions';
export default {

    components: {
        Icon,
        EditorContent,
        EditorMenuBar,
        EditorIcon,
    },
    data() {
        return {
            editor: new Editor({
                content: '<p class="text-4xl ">Type Here...</p>',
                extensions:[
                    new Blockquote(),
                    new BulletList(),
                    new CodeBlock(),
                    new HardBreak(),
                    new Heading({ levels: [1, 2, 3] }),
                    new ListItem(),
                    new OrderedList(),
                    new TodoItem(),
                    new TodoList(),
                    new Link(),
                    new Bold(),
                    new Code(),
                    new Italic(),
                    new Strike(),
                    new Underline(),
                    new History(),
                ],
                content:[],
            }),

        };
    },
    beforeDestroy() {
        this.editor.destroy()
    },
    methods: {
        save() {
            console.log(this.$refs.editor.getdata());
        }
    }
};
</script>

