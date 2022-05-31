/**
 * File DOC
 * 
 * @Description Componente da Navegação Lateral do APP.
 * @ChangeLog 
 *  - Vinícius Lessa - 26/05/2022: Criação do Arquivo e documentação de Cabeçalho. Início da Estilização.
 *  - Vinícius Lessa - 28/05/2022: Continuação da implementação dos estilos e funcionalidades, como de Sign-out.
 *  - Vinícius Lessa - 35/05/2022: Finzalização do processo de naveção após SignIn/SignOut (CustomActions.reset).
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
import {   
    View ,
    Text ,    
    ScrollView ,
    TouchableOpacity ,
    Image ,
    ActivityIndicator, 
    Alert,
} from 'react-native'; // Core Components

import { CommonActions } from '@react-navigation/native'; // React Navigation

import { css } from '../../assets/css/css.js'; // Style - css

import {
    DrawerContentScrollView,
    DrawerItemList,
} from '@react-navigation/drawer';

// Icons
import { Ionicons } from '@expo/vector-icons';
import { AntDesign } from '@expo/vector-icons';
import { FontAwesome } from '@expo/vector-icons'; 

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage


// Loading Component
const LoadingIcon = () => {
    return (
      <View style={ [ css.container, css.p_TwoY, { backgroundColor: '#dadada' } ] }>
        <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
          <View style = { [ css.centerSelf, css.widthAuto ] }>
            <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
          </View>
        </View>
      </View>
    );
};

const ProfileSection = (props) => {            

    // Loagado
    if (props.isLoggedUser) {

        return(
            <View style={ [ css.p_OneY ] }>                                
                
                <View style={ [ css.rowOrientation ] }>                    

                    {/* Profile Pic */}
                    <View style={ [ css.centerSelf, css.flexOne, { left: 11 } ] }>
                        <TouchableOpacity style={ [ css.endtHorizontaly, css.m_TwoRight ] }>
                            <Image
                                source={ {uri: props.userPhotoURL } }
                                style={ css.profileImageSideBar }
                            />
                        </TouchableOpacity>                    
                    </View>

                    {/* User Name */}
                    <View style={ [ css.centerSelf, css.flexOne, { left: 11 } ] }>
                        <Text style={ [ css.textGray, css.size14 ] }>Bem Vindo</Text>
                        <Text style={ [ css.textRed, css.size22, css.fontBebas ] }>{props.userName}</Text>
                    </View>                    

                    {/* Logout Button */}
                    <View>
                        <TouchableOpacity 
                            style={ [ css.endtHorizontaly ] }
                            onPress={ () => props.signOutUser() }
                        >                        
                            <FontAwesome name="sign-out" size={24} color="black" style={ [ css.endtHorizontaly, css.m_TwoRight, css.m_OneTop ] } />
                        </TouchableOpacity>
                    </View>                                    
                </View>

            </View>            
        );
    } else {

        return(
            <View style={ [ css.rowOrientation ] }>
                <View style={ [ css.centerSelf, css.flexOne ] }>
                    <Ionicons style={ [ css.endtHorizontaly ] } name="person-circle-sharp" size={100} color="#eb1f36" />
                </View>
                <View style={ [ css.centerSelf, css.flexOne ] }>
                    <TouchableOpacity onPress={()=>props.navigation.navigate('Entrar')}>
                        <Text style = { [css.size24, css.textRed] }>ENTRAR</Text>
                    </TouchableOpacity>
                </View>
            </View>  
        );
    }
}

const SideBar = (props) => {    

    // User Data
    const [userEmail        , setUserEmail]     = useState(null);
    const [userProfilePic   , setProfilePic]    = useState(null);
    const [userPass         , setUserPass]      = useState(null);
    const [userId           , setUserID]        = useState(null);
    const [userName         , setUserName]      = useState(null);

    const [isLoading        , setIsLoading]     = useState(false);

    // Remove 'Welcome' from Drawer List
    const { state, ...rest } = props;
    
    const newState = { ...state}  // Copy from state before applying any filter. do not change original state
    
    newState.routes = newState.routes.filter(item => item.name !== 'Welcome') // Replace "Welcome' with your route name


    // Sing-Out Function
    async function signOutUser() {

        setIsLoading(true);
    
        const keys = [
            '@MTC:userEmail' , 
            '@MTC:userProfilePic' ,
            '@MTC:userPassword' ,
            '@MTC:userID' ,
            '@MTC:userName'
        ]
        
        try {
            await AsyncStorageLib.multiRemove(keys)
            
            console.log("Sign-Out com sucesso!!!")

            setIsLoading(false);

            return props.navigation.dispatch(
                CommonActions.reset({
                    index: 0, // Entrar
                    routes: [
                        { name: 'SignIn' },
                    ],
                })
            );

        } catch(e) {
            // error
            console.log(e);

        } 
    }

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( async () => {       

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

    // Booleans
    const isLoggedUser   = !!userName;    

    return (
        <ScrollView style={ [ { backgroundColor: '#dadada' } ] }>
            <DrawerContentScrollView>

                <ProfileSection 
                    userName={userName}
                    userPhotoURL={userProfilePic}                    
                    isLoggedUser={isLoggedUser}
                    navigation={props.navigation}
                    signOutUser={signOutUser}
                />

                {isLoading && <LoadingIcon />}

                <View style={ css.hrLightGrey } />
                
                <View style={ [ {paddingHorizontal: 10} ] }>
                    <View style={css.rowOrientation}>
                        <Text style = { [css.size24, css.textBlack, css.fontBebas, css.m_ThreeLeft, css.m_ThreeY] }>Navegação</Text>
                        <AntDesign name="down" size={20} color="black" style={{ top: 18, left: 10 }} />
                    </View>

                    {/* <TouchableOpacity onPress={()=>props.navigation.navigate('Exemple')}>
                        <Text style = { [css.size24, css.textRed] }>Exemple</Text>
                    </TouchableOpacity> */}                    

                    <DrawerItemList
                        state={newState} {...rest}
                    />
                </View>
                
            </DrawerContentScrollView>
        </ScrollView>
    );
}

export default SideBar;