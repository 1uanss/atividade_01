import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Conselhos para Educar Filhos',
      theme: ThemeData(
        primaryColor: Colors.teal,
        fontFamily: 'Roboto',
      ),
      home: AdviceList(),
    );
  }
}

class AdviceList extends StatefulWidget {
  @override
  _AdviceListState createState() => _AdviceListState();
}

class _AdviceListState extends State<AdviceList> {
  String name = '';
  String age = '';
  String city = '';
  TextEditingController nameController = TextEditingController();
  TextEditingController ageController = TextEditingController();
  TextEditingController cityController = TextEditingController();
  TextEditingController adviceController = TextEditingController();
  TextEditingController editController = TextEditingController();
  List<Map<String, dynamic>> adviceList = [];
  int editingIndex = -1;

  void startSecondStep() {
    setState(() {
      // Armazenar as informações do primeiro passo
      name = nameController.text;
      age = ageController.text;
      city = cityController.text;
      // Limpar os controladores
      nameController.clear();
      ageController.clear();
      cityController.clear();
    });
  }

  void addAdvice(String advice) {
    setState(() {
      adviceList.add({'name': name, 'age': age, 'city': city, 'advice': advice});
      adviceController.clear();
    });
  }

  void deleteAdvice(int index) {
    setState(() {
      adviceList.removeAt(index);
      cancelEditing(); // Cancelar edição ao excluir um conselho
    });
  }

  void startEditing(int index) {
    setState(() {
      editingIndex = index;
      editController.text = adviceList[index]['advice'];
    });
  }

  void saveEditing() {
    setState(() {
      adviceList[editingIndex]['advice'] = editController.text;
      editingIndex = -1;
      editController.clear();
    });
  }

  void cancelEditing() {
    setState(() {
      editingIndex = -1;
      editController.clear();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Conselhos para Educar Filhos'),
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: name.isEmpty
                ? Column(
                    children: [
                      TextField(
                        controller: nameController,
                        decoration: InputDecoration(
                          labelText: 'Nome',
                          filled: true,
                          fillColor: Colors.white,
                        ),
                      ),
                      SizedBox(height: 8),
                      TextField(
                        controller: ageController,
                        decoration: InputDecoration(
                          labelText: 'Idade',
                          filled: true,
                          fillColor: Colors.white,
                        ),
                        keyboardType: TextInputType.number,
                      ),
                      SizedBox(height: 8),
                      TextField(
                        controller: cityController,
                        decoration: InputDecoration(
                          labelText: 'Cidade',
                          filled: true,
                          fillColor: Colors.white,
                        ),
                      ),
                      SizedBox(height: 16),
                      ElevatedButton(
                        onPressed: () {
                          startSecondStep();
                        },
                        child: Text('Próximo'),
                      ),
                    ],
                  )
                : Row(
                    children: [
                      Expanded(
                        child: Text(
                          'Olá, $name! Deixe seu conselho:',
                          style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                        ),
                      ),
                    ],
                  ),
          ),
          if (name.isNotEmpty) ...[
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Row(
                children: [
                  Expanded(
                    child: TextField(
                      controller: adviceController,
                      decoration: InputDecoration(
                        labelText: 'Adicione um conselho',
                        filled: true,
                        fillColor: Colors.white,
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10.0),
                        ),
                      ),
                      onSubmitted: (text) {
                        if (editingIndex == -1) {
                          addAdvice(text);
                        } else {
                          saveEditing();
                        }
                      },
                    ),
                  ),
                  SizedBox(width: 8),
                  ElevatedButton(
                    onPressed: () {
                      if (editingIndex == -1) {
                        addAdvice(adviceController.text);
                      } else {
                        saveEditing();
                      }
                    },
                    child: Text(editingIndex == -1 ? 'Adicionar' : 'Salvar'),
                  ),
                ],
              ),
            ),
            Expanded(
              child: ListView.builder(
                itemCount: adviceList.length,
                itemBuilder: (context, index) {
                  return Card(
                    elevation: 3,
                    margin: EdgeInsets.symmetric(vertical: 8, horizontal: 16),
                    child: ListTile(
                      leading: Text(
                        '😊', // Emoji de um rosto feliz
                        style: TextStyle(fontSize: 24),
                      ),
                      title: editingIndex == index
                          ? TextField(
                              controller: editController,
                              decoration: InputDecoration(
                                filled: true,
                                fillColor: Colors.white,
                              ),
                            )
                          : Text(
                              adviceList[index]['advice'],
                              style: TextStyle(
                                fontSize: 16,
                              ),
                            ),
                      trailing: Row(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          if (editingIndex == index)
                            IconButton(
                              icon: Icon(Icons.save),
                              onPressed: saveEditing,
                            )
                          else
                            IconButton(
                              icon: Icon(Icons.edit),
                              onPressed: () {
                                startEditing(index);
                              },
                            ),
                          IconButton(
                            icon: Icon(Icons.delete),
                            onPressed: () {
                              deleteAdvice(index);
                            },
                          ),
                        ],
                      ),
                    ),
                  );
                },
              ),
            ),
          ],
        ],
      ),
    );
  }
}
