// import das bibliotecas
import React from 'react';
import { View, Text, StyleSheet, TextInput, TouchableOpacity } from 'react-native';
import * as Animatable from 'react-native-animatable'
import { useNavigation } from '@react-navigation/native';

// Criando a função sigIn para a tela de login 
export default function LogIn() {
   //Const navigation permite o uso da biblioteca navigation para navegação entre as paginas
    const navigation = useNavigation();
    return (
       //Criação do cabeçario da pagina dos campos de input e o direcionamento para a pagina de criação de cadastro
       <View style={styles.container}>
            <Animatable.View animation="fadeInLeft" delay={500} style={styles.containerHeader}>
                <Text style={styles.message}>ENTRAR</Text>
            </Animatable.View>
                    <Text style={styles.registerText}>Digite seus dados para entrar no sistema</Text>
            <Animatable.View animation="fadeInUp" style={styles.containerForm}>
              
                <TextInput
                    placeholder="E-mail"
                    style={styles.input}
                    />               
                <TextInput
                    placeholder="Senha"
                    style={styles.input}
                />

            <TouchableOpacity style={styles.buttonRegister}>
                    <Text style={styles.registerText}>Esqueceu a sua senha?</Text>
                </TouchableOpacity>

                <TouchableOpacity style={styles.button}>
                    <Text style={styles.buttonText}>Acessar</Text>
                </TouchableOpacity>
               
                <TouchableOpacity   
                     style={styles.buttonRegister}
                     onPress={() => navigation.navigate('Create')} >
                    <Text style={styles.registerText}>Não possui uma conta? Cadastre-se</Text>
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
    },
    containerHeader:{
        marginTop: '14%',
        marginBottom: '8%',
        paddingStart: '5%',
    },
    message:{
        textAlign: 'center',
        fontSize: 35,
        fontWeight: 'bold',
        color:'#FFF'
    },
    input:{
        textAlign: 'center', 
        alignContent: 'center',
        height: 50,
        marginTop: 15,
         borderWidth: 3,
         borderColor: 'black',
         borderRadius: 20,
         backgroundColor : "#FFFFFF" ,
    },
    button:{
        backgroundColor: 'red',
        width: '100%',
        borderWidth: 4,
        borderRadius: 4,
        paddingVertical: 8,
        marginTop: 185,
        justifyContent: 'center',
        alignItems: 'center'
    },
    buttonText:{
        textAlign: 'center',
        color: '#FFF',
        fontSize: 18,
        fontWeight: 'bold',
    },
    buttonRegister: {
        marginTop: 14,
        alignSelf: 'center'
    },
    registerText:{
        color:'#a1a1a1',
        textAlign:'center',
        marginBottom: 95,
    }
})