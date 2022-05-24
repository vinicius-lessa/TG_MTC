import React from 'react';
import { 
    View, 
    Text, 
    StyleSheet, 
    TextInput, 
    TouchableOpacity 
} from 'react-native';

import * as Animatable from 'react-native-animatable'

import { useNavigation } from '@react-navigation/native';

export default function NewTradePost() {

    const navigation = useNavigation();

    return (
       //Criação do cabeçario da pagina e dos campos de input 
       <View style={styles.container}>
            <Animatable.View animation="fadeInLeft" delay={500} style={styles.containerHeader}>
                <Text style={styles.message}>CRIAR ANÚNCIO</Text>
            </Animatable.View>
            <Animatable.View animation="fadeInUp" style={styles.containerForm}>
              
                <TextInput
                    placeholder="Categoria"
                    style={styles.input}
                    />               
                <TextInput
                    placeholder="Nome do produto"
                    style={styles.input}
                />
                <TextInput
                    placeholder="Valor do produto"
                    style={styles.input}
                />
                <TextInput
                    placeholder="Estado de uso"
                    style={styles.input}
                />
                <TextInput
                    placeholder="Descrição"
                    style={styles.input}
                />
                
                <TouchableOpacity style={styles.button}>
                    <Text style={styles.buttonText}>Publicar</Text>
                </TouchableOpacity>
               
            </Animatable.View>
        </View>
    );
}

//Styles
const styles = StyleSheet.create({
    container:{
        flex:1,
        backgroundColor: 'black'
    } ,
     
    containerHeader:{
        marginTop: '14%',
        marginBottom: '8%',
        paddingStart: '5%',
    } ,

    message:{
        textAlign: 'center',
        fontSize: 35,
        fontWeight: 'bold',
        color:'#FFF'
    } ,

    input:{
        textAlign: 'center', 
        alignContent: 'center',
        height: 50,
        marginTop: 20,
        borderWidth: 3,
        borderColor: 'black',
        borderRadius: 20,
        backgroundColor : "#FFFFFF" ,
    } ,
    button:{
        backgroundColor: 'red',
        width: '100%',
        borderWidth: 4,
        borderRadius: 4,
        paddingVertical: 8,
        marginTop: 200,
        justifyContent: 'center',
        alignItems: 'center'
    } ,
    buttonText:{
        textAlign: 'center',
        color: '#FFF',
        fontSize: 18,
        fontWeight: 'bold',
    } ,
})