/**
 * File DOC
 * 
 * @Description Página 'SignIn' para login de usuários. Pode apontar para SignUp ocasionalmente.
 * @ChangeLog 
 *  - Vinícius Lessa - 26/05/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 * 
 */

import React, { useEffect, useState } from 'react';  // JSX Compilation
import { 
    View,
    Text,    
    TextInput,
    TouchableOpacity,
    SafeAreaView,
    Alert
} from 'react-native'; // Core Components

import HeaderDefault from './components/Header';

import { css } from '../assets/css/css.js'; // Style - css
import * as Animatable from 'react-native-animatable'  // Animation

import api from '../services/api'; // API Sauce

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage


const SignIn = (props) => {
        
    // User error message
    const [display, setDisplay]             = useState('none');

    // Form
    const [userText, setUserText]           = useState(null);
    const [userPassword, setUserPassword]   = useState(null);
    
    const [errorMessage, setErrorMessage]   = useState(null);

    // User Info / Backend
    const [userName      , setUserName]     = useState(null);
    const [userEmail     , setUserEmail]    = useState(null);
    const [userProfilePic, setProfilePic]   = useState(null);


    // SignIn Function
    async function signIn() {
        let tokenUrl = '16663056-351e723be15750d1cc90b4fcd' ;
        let route  = "/users.php/?token=" + tokenUrl + "&key=SignIn";

        try {
        const response = await api.post(route, {
            email: 'vinicius.lessa33@gmail.com' ,
            password: '123456' ,
        });

        // const { user, token } = response.data ;

        // await AsyncStorageLib.multiSet([
            // ['@MTC:token', token],
            // ['@MTC:userName', JSON.stringify(user)],
            // ['@MTC:userName', ];
            // ['@MTC:userEmail', ];
            // ['@MTC:userProfilePic', ];
        // ]);

        // setLoggedInUser(JSON.stringify(user)); //State

        // Alert.Alert("Login Realizado com Sucesso!");

        // Continuar de: https://youtu.be/fBrOtR3pgPU - 25:35

        } catch(response) {            
            setErrorMessage("Erro: " + response.data.msg);

        }
    }

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( async () => {
        // Form
        // console.log(userText);
        // console.log(userPassword);

        // const token         = await AsyncStorageLib.getItem('@MTC:token');
        const userNameLocal         = await AsyncStorageLib.getItem('@MTC:userName');
        const userEmailLocal        = await AsyncStorageLib.getItem('@MTC:userEmail');
        const userProfilePicLocal   = await AsyncStorageLib.getItem('@MTC:userProfilePic');

        // console.log(userNameLocal);

        if ( userNameLocal && userEmailLocal && userProfilePicLocal)
            setUserName(userNameLocal);
            setUserEmail(userEmailLocal);
            setProfilePic(userProfilePicLocal);
    });

    return (
        <SafeAreaView style={css.container}>
            
            {/* Header */}
            <HeaderDefault 
                title="Entrar"                
                userName={null}
                userPhotoURL={null}
                navigation={props.navigation}
                isLoggedUser={false}
                hideRightIcon={true}
            />

            {/* Header */}
            <View style={ [ css.flexOne, css.centerVerticaly ]}>
                <View style={css.centerVerticaly}>
                    <Animatable.View animation="fadeInLeft" delay={300}>
                        <Text style={ [ 
                            css.textLightgray, 
                            css.centerSelf ,
                            css.m_FourTop
                        ]}>
                            Digite seus dados para entrar no App
                        </Text>
                    </Animatable.View>
                </View>
            </View>

            {/* Log Messages */}
            { !!errorMessage && 
                <View style={ [ css.container, css.centerVerticaly, css.centerChildren ] }>
                    <Text style={ [css.size20, css.textWhite, css.fontBold,  { marginVertical: 20 } ] }>
                        ...
                    </Text>                
                </View>
            }
            
            {/* Form */}
            <View style={ [ css.flexThree ]}>
                <Animatable.View animation="fadeInUp" style={ [ css.m_Three ]}>                    
                    
                    {/* Not Visible by Default */}
                    <View>
                        <Text style={ [ css.loginMsg(display), css.size16, css.centerSelf ]}>
                            Usuário ou Senha Inválidos!
                        </Text>
                    </View>

                    {/* Inputs */}
                    <View>
                        <TextInput
                            placeholder="E-mail"
                            style={ [ css.inputDefault, css.m_Three ] }
                            onChangeText={text=>setUserText(text)}
                            />
                        <TextInput
                            placeholder="Senha"
                            style={ [ css.inputDefault, css.m_Three ] }
                            secureTextEntry={true} onChangeText={text=>setUserPassword(text)}
                        />
                    </View>

                    {/* Bottom Page */}
                    <View>
                        <View style = { [ css.m_FourBottom ] }>
                            <TouchableOpacity 
                                style={ [ css.m_OneY, css.centerSelf ] }
                                onPress={()=>{Alert.alert("Função em Desenvolvimento!")}}
                            >
                                <Text style={ [css.textWhite, css.centerText] }>
                                    Esqueceu a sua <Text style={ [ css.fontBold, css.underlineText ] }>Senha</Text>?
                                </Text>
                            </TouchableOpacity>
                        </View>
                        
                        <View style = { [ css.m_FourY ] }>
                            <TouchableOpacity
                                style={ [css.buttonDefault, { width: '55%' }] }
                                onPress={()=>sendForm()}
                            >
                                <Text style={ [css.size20, css.textWhite, css.fontBold] }>
                                    Acessar
                                </Text>
                            </TouchableOpacity>
                        </View>
                    
                        <View style = { [ css.m_FourTop ] }>
                            <TouchableOpacity
                                onPress={()=>props.navigation.navigate('Criar Conta')}
                            >
                                <Text style={ [css.textWhite, css.centerText] }>
                                    Não possui Conta?  <Text style={ [ css.fontBold, css.underlineText ] }>Cadastre-se</Text>
                                </Text>
                            </TouchableOpacity>
                        </View>
                    </View>
            
                </Animatable.View>

            </View>
        </SafeAreaView>
    );
}

export default SignIn;