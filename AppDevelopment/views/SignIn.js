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
    View ,
    Text ,
    TextInput ,
    TouchableOpacity ,
    SafeAreaView ,
    Alert ,
    ActivityIndicator ,
} from 'react-native'; // Core Components

import HeaderDefault from './components/Header';

import { css } from '../assets/css/css.js'; // Style - css
import * as Animatable from 'react-native-animatable'  // Animation

import api from '../services/api'; // API Sauce

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage

import { ScrollView } from 'react-native-gesture-handler';


// Loading Component
const LoadingIcon = () => {
    return (
      <View style={css.container}>
        <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
          <View style = { [ css.centerSelf, css.widthAuto ] }>
            <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
          </View>
        </View>
      </View>
    );
  };

const SignIn = (props) => {

    // Form
    const [emailInput    , setEmailInput]       = useState(null);
    const [passwordInput , setPasswordInput]    = useState(null);
    
    // Error Msg
    const [errorMessage  , setErrorMessage]     = useState(null);

    // User Logged Data
    const [userEmail        , setUserEmail]     = useState(null);
    const [userProfilePic   , setProfilePic]    = useState(null);
    const [userPass         , setUserPass]      = useState(null);
    const [userId           , setUserID]        = useState(null);
    const [userName         , setUserName]      = useState(null);

    // Loading Bool
    const [isLoading  , setIsLoading]       = useState(false);


    // SignIn Function
    async function signIn() {

        setIsLoading(true);

        let tokenUrl = '16663056-351e723be15750d1cc90b4fcd' ;
        let route  = "/SignIn/index.php";           

        try {
            const response = await api.post(route, 
                { 
                    token: tokenUrl, 
                    userEmail: emailInput, 
                    userPassword: passwordInput 
                }, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                } );            

            const emailText     = response.data.data.email ;
            const photoUrl      = response.data.data.image_name ;            
            const idText        = response.data.data.user_id ;
            const nameText      = response.data.data.user_name ;            

            await AsyncStorageLib.multiSet([
                // ['@MTC:token'           , token],
                ['@MTC:userEmail'       , emailText] ,
                ['@MTC:userProfilePic'  , photoUrl] ,
                ['@MTC:userPassword'    , passwordInput ] ,
                ['@MTC:userID'          , idText] ,
                ['@MTC:userName'        , nameText] , 
            ]);
            
            console.log("SignIn com sucesso!!!")

            setIsLoading(false);

            return props.navigation.navigate('Welcome', {
                userName: nameText
            });

        } catch(response) {                            
            setErrorMessage(response.data.msg);

            console.log(response.data);

            setIsLoading(false);
        }        
    }    

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( async () => {
        // Form Values
        // console.log(emailInput);
        // console.log(passwordInput);

        // const token         = await AsyncStorageLib.getItem('@MTC:token');
        const userEmailSession      = await AsyncStorageLib.getItem('@MTC:userEmail');
        const userProfilePicSession = await AsyncStorageLib.getItem('@MTC:userProfilePic');
        const userPasswordSession   = await AsyncStorageLib.getItem('@MTC:userPassword');
        const userIDSession         = await AsyncStorageLib.getItem('@MTC:userID');
        const userNameSession       = await AsyncStorageLib.getItem('@MTC:userName');        

        if ( userEmailSession && userProfilePicSession && userPasswordSession && userIDSession && userNameSession )            
            setUserEmail(userEmailSession);
            setProfilePic(userProfilePicSession);
            setUserPass(userPasswordSession);
            setUserID(userIDSession);
            setUserName(userNameSession);
            
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

            <ScrollView>                            
                
                {isLoading && <LoadingIcon />}

                {/* User Info */}
                {/* <View style={{ color: 'white', fontSize: 20 }}>
                    <Text style={{ color: 'white', fontSize: 20 }}>E-mail {userEmail}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>Url do Perfil: {userProfilePic}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>Senha: {userPass}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>ID: {userId}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>Nome: {userName}</Text>
                </View> */}

                {/* Header */}
                <View style={ [ css.centerVerticaly, { height: 100 } ]}>
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
                
                {/* Form */}
                <View style={ [ css.flexThree ]}>
                    <Animatable.View animation="fadeInUp" style={ [ css.m_Three ]}>                    
                                            
                        {/* Log Messages */}
                        { !!errorMessage && 
                            <View>
                                <Text style={ [ css.loginMsg, css.size16, css.centerSelf ]}>
                                    {errorMessage}
                                </Text>
                            </View>
                        }                    

                        {/* Inputs */}
                        <View>
                            <TextInput
                                placeholder="E-mail"
                                style={ [ css.inputDefault, css.m_Three ] }
                                onChangeText={text=>setEmailInput(text)}
                                />
                            <TextInput
                                placeholder="Senha"
                                style={ [ css.inputDefault, css.m_Three ] }
                                secureTextEntry={true} onChangeText={text=>setPasswordInput(text)}
                            />
                        </View>

                        {/* Bottom of Page */}
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
                                    onPress={()=>signIn()}
                                >
                                    <Text style={ [css.size20, css.textWhite, css.fontBold] }>
                                        Acessar
                                    </Text>
                                </TouchableOpacity>
                            </View>
                        
                            <View style = { [ css.m_FourTop ] }>
                                <TouchableOpacity
                                    onPress={()=>props.navigation.navigate('SignUp')}
                                >
                                    <Text style={ [css.textWhite, css.centerText] }>
                                        Não possui Conta?  <Text style={ [ css.fontBold, css.underlineText ] }>Cadastre-se</Text>
                                    </Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                
                    </Animatable.View>

                </View>
            </ScrollView>
        </SafeAreaView>
    );
}

export default SignIn;