// Import das bibliotecas
import React from 'react';
import { View, Text, StyleSheet, TextInput, TouchableOpacity } from 'react-native';
import * as Animatable from 'react-native-animatable'
import { useNavigation } from '@react-navigation/native';

// Criando a função Home
export default function Home() {
   //Const navigation permite o uso da biblioteca navigation para navegação entre as paginas
    const navigation = useNavigation();
    return (
       //Criado header da pagina e o botão funcional de entrar 
       <View style={styles.container}>
            <Animatable.View animation="fadeInLeft" delay={500} style={styles.containerHeader}>
                <Text style={styles.message}>ANUNCIOS</Text>
            </Animatable.View>
       <View style={styles.containerLogo}>
            <TouchableOpacity 
        style={styles.button}
        onPress={() => navigation.navigate('LogIn')}
        >
            <Animatable.Image
                animation="flipInY"
                source={require('../../assets/entrar.png')}
                resizeMode = "contain"
                style={{
                  width: 100,
                  height: 100,  
              }}/>
             </TouchableOpacity>
        </View>

        <View style={styles.imganuncio1}>      
        <Animatable.Image
          animation="flipInY"
          source={require('../../assets/pedaleira.png')}
          resizeMode = "contain"
          style={{
            width: 100,
            height: 100,  
        }}/>
        </View>

        <Text style={styles.anuncio1T}>Pedaleira Mooer Ge200</Text>
        <Text style={styles.anuncio1C}>Categoria:</Text> 
        <Text style={styles.textped}>Pedais</Text>
        <Text style={styles.stats1}>Status:</Text>
        <Text style={styles.statsS1}>Seminova</Text>
        <Text style={styles.preco1}>R$:2.215,00</Text>
        <TouchableOpacity 
        style={styles.button1}>
        <Text style={styles.buttonText1}>Detalhes</Text>  
        </TouchableOpacity>
        <View style={styles.imganuncio2}>   
        <Animatable.Image
                animation="flipInY"
                source={require('../../assets/baixostring.png')}
                resizeMode = "contain"
                style={{
                  width: 100,
                  height: 100,  
              }}/>
        </View>
       <Text style ={styles.anuncio2T}>Baixo Strinberg 4 cordas</Text>
       <Text style={styles.anuncio2C}>Categoria:</Text> 
       <Text style={styles.textbai}>Contrabaixo ativo</Text>
       <Text style={styles.stats2}>Status:</Text>
       <Text style={styles.statsU2}>Usado</Text>
       <Text style={styles.preco2}>R$:1.100,00</Text>
       <TouchableOpacity 
        style={styles.button2}>
        <Text style={styles.buttonText2}>Detalhes</Text>  
        </TouchableOpacity>
        <View style={styles.imganuncio3}>   
        <Animatable.Image
                animation="flipInY"
                source={require('../../assets/guitar.png')}
                resizeMode = "contain"
                style={{
                  width: 100,
                  height: 100,  
              }}/>
        </View>
       <Text style ={styles.anuncio3T}>Guitarra Strinberg CLP79</Text>
       <Text style={styles.anuncio3C}>Categoria:</Text> 
       <Text style={styles.textgui}>Guitarra</Text>
       <Text style={styles.stats3}>Status:</Text>
       <Text style={styles.statsU3}>Seminova</Text>
       <Text style={styles.preco3}>R$:1.200,00</Text>
       <TouchableOpacity 
        style={styles.button3}>
        <Text style={styles.buttonText3}>Detalhes</Text>  
        </TouchableOpacity>



        
        </View>
    );
}

//Styles
const styles = StyleSheet.create({
    container:{
        flex:1,
        backgroundColor: 'black'
    },
    containerLogo:{
      position:'absolute',
      left: 300,
      top: 15,
      justifyContent: 'center',
      alignItems: 'center'
    },
    containerHeader:{
       marginTop: 40,
    },
    message:{
      textAlign: 'center',
      fontSize: 35,
      fontWeight: 'bold',
      color:'#FFF',
    },
    imganuncio1:{
      position:'absolute',
      bottom:570,
    },
    anuncio1T:{
      fontSize: 20,
      color:'#FFF',
      position:'absolute',
      left:100,
      top:117
    },
    anuncio1C:{
      fontSize: 13,
      color:'red',
      position:'absolute',
      left:100,
      top:145  
    },
    textped:{
      color:'gray',
      fontSize: 13,
      position:'absolute',
      left:163,
      top:145  
    },
    stats1:{
      color:'red',
      fontSize: 13,
      position:'absolute',
      left:100,
      top:165,  
    },
    statsS1:{
      color:'gray',
      fontSize: 13,
      position:'absolute',
      left:143,
      top:165 
    },
    preco1:{
      color:'white',
      fontSize: 20,
      position:'absolute',
      left:100,
      top:190 
    },
    button1:{
      position: 'absolute',
      backgroundColor: 'red',
      borderRadius: 50,
      paddingVertical: 8,
      width: '35%',
      alignSelf: 'center',
      right: '10%',
      bottom: '71%',
      alignItems: 'center',
    },
    buttonText1:{
      fontSize: 18,
      color: '#FFF',
      fontWeight: 'bold'
    },
    imganuncio2:{
      position:'absolute',
      bottom:410,
      left:300,
    },
    anuncio2T:{
      fontSize: 20,
      color:'#FFF',
      position:'absolute',
      right:185,
      top:275
    },
    anuncio2C:{
      fontSize: 13,
      color:'red',
      position:'absolute',
      right:345,
      top:305  
    },
    textbai:{
      color:'gray',
      fontSize: 13,
      position:'absolute',
      right:239,
      top:305  
    },
    stats2:{
      color:'red',
      fontSize: 13,
      position:'absolute',
      right:363,
      top:330,  
    },
    statsU2:{
      color:'gray',
      fontSize: 13,
      position:'absolute',
      right:320,
      top:330,
    },
    preco2:{
      color:'white',
      fontSize: 20,
      position:'absolute',
      right:135,
      top:355 
    },
    button2:{
      position: 'absolute',
      backgroundColor: 'red',
      borderRadius: 50,
      paddingVertical: 8,
      width: '35%',
      alignSelf: 'center',
      left: '2%',
      bottom: '50%',
      alignItems: 'center',
    },
    buttonText2:{
      fontSize: 18,
      color: '#FFF',
      fontWeight: 'bold'
    },
    imganuncio3:{
      position:'absolute',
      bottom:210,
      right:300,
    },
    anuncio3T:{
      fontSize: 20,
      color:'#FFF',
      position:'absolute',
      left:120,
      top:475
    },
    anuncio3C:{
      fontSize: 13,
      color:'red',
      position:'absolute',
      left:121,
      top:505  
    },
    textgui:{
      color:'gray',
      fontSize: 13,
      position:'absolute',
      left:185,
      top:505  
    },
    stats3:{
      color:'red',
      fontSize: 13,
      position:'absolute',
      left:121,
      top:530,  
    },
    statsU3:{
      color:'gray',
      fontSize: 13,
      position:'absolute',
      left:165,
      top:530,
    },
    preco3:{
      color:'white',
      fontSize: 20,
      position:'absolute',
      left:120,
      top:555 
    },
    button3:{
      position: 'absolute',
      backgroundColor: 'red',
      borderRadius: 50,
      paddingVertical: 8,
      width: '35%',
      alignSelf: 'center',
      right: '5%',
      bottom: '25%',
      alignItems: 'center',
    },
    buttonText3:{
      fontSize: 18,
      color: '#FFF',
      fontWeight: 'bold'
    },




























})