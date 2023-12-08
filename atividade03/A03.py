# Importando as classes necessárias da biblioteca Kivy
from kivy.app import App
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.textinput import TextInput
from kivy.uix.label import Label
from kivy.uix.button import Button
from kivy.uix.checkbox import CheckBox

# Definindo a classe principal da aplicação Kivy
class MyApp(App):
    def build(self): 

        # Criação do layout principal da aplicação
        layout = BoxLayout(orientation='vertical', spacing=10, padding=10)

        # Campo de entrada para o nome
        nome_label = Label(text='Nome:')
        nome_input = TextInput(multiline=False)
        layout.add_widget(nome_label)
        layout.add_widget(nome_input)

        # Campo de seleção para o sexo
        sexo_label = Label(text='Sexo:')
        feminino_checkbox = CheckBox(group='sexo', active=True)
        masculino_checkbox = CheckBox(group='sexo', active=False)
        layout.add_widget(sexo_label)
        layout.add_widget(feminino_checkbox)
        layout.add_widget(Label(text='Feminino'))
        layout.add_widget(masculino_checkbox)
        layout.add_widget(Label(text='Masculino'))

        # Botão de submissão
        button = Button(text='Enviar', on_press=self.validate_and_submit)
        layout.add_widget(button)

        return layout

    # Método para realizar a validação dos dados ao pressionar o botão
    def validate_and_submit(self, instance):
        nome_input = self.root.children[0].children[1]
        sexo = 'Feminino' if self.root.children[2].children[1].active else 'Masculino'

        # Realização da validação do formulário
        if nome_input.text == "":
            print("Preenchimento obrigatório")
        else:
            print(f"Nome: {nome_input.text}, Sexo: {sexo}")

# Verifica se o script está sendo executado diretamente
if __name__ == '__main__':
    # Inicia a aplicação chamando o método
    MyApp().run()
