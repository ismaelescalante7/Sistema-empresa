<script setup>
import Editor from '@tinymce/tinymce-vue'

const emit = defineEmits(['onSubmit'])

const props = defineProps({
  showSave: {
    type: Boolean,
    default: false
  }
})

const save = () => {
  emit('onSubmit')
}

const filePickerCallback = (callback) => {
  const input = document.createElement('input')
  input.setAttribute('type', 'file')
  input.setAttribute('accept', 'image/*')
  input.onchange = () => {
    const file = input.files[0]
    const reader = new FileReader()
    reader.onload = (e) => {
      callback(e.target.result, { title: file.name })
    }
    reader.readAsDataURL(file)
  }
  input.click()
}

const setupEditor = (editor) => {
  editor.ui.registry.addButton('images', {
    icon: 'image',
    tooltip: 'Insertar/editar imagen',
    onAction: () => {
      filePickerCallback((url, alt) => {
        editor.insertContent(`<img src="${url}" alt="${alt.title}"/>`)
      })
    }
  })
}

</script>
<template>
  <Editor
    api-key="qp59e1br7th3le3gu7592s8fefvomabnffonw5cm5wjyflyn"
    model-events="change"
    :init="{
      plugins: 'save lists link image table help',
      toolbar:
      `${props.showSave ? 'save' : ''} | undo redo | blocks fontfamily fontsize | alignleft aligncenter alignright alignjustify | bold italic underline strikethrough | link images table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat`,
      language: 'es',
      language_url: '/langs/es.js',
      branding: false,
      save_onsavecallback: save,
      help_tabs: [
        'shortcuts',
      ],
      menubar: 'file edit insert format table tools help',
      menu: {
        format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
      },
      file_picker_callback: filePickerCallback,
      image_description: false,
      image_dimensions: false,
      setup: setupEditor,
    }"
  />
</template>
