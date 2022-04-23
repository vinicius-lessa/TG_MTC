//Import das bibliotecas
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import Welcome from '../pages/Welcome'
import LogIn from '../pages/LogIn'
import Home from "../pages/Home";
import Create from "../pages/Create";

//Gera uma constante do tipo stack 
const Stack = createNativeStackNavigator();

//Função routes que permite a navegação entre as paginas 
export default function Routes(){
    return(
        <Stack.Navigator>
            <Stack.Screen
                name="Welcome"
                component={Welcome}
                options={{headerShown: false}}
            />
            <Stack.Screen
                name="LogIn"
                component={LogIn}
                options={{headerShown: false}}
            />
            <Stack.Screen
                name="Home"
                component={Home}
                options={{headerShown: false}}
            />
            <Stack.Screen
                name="Create"
                component={Create}
                options={{headerShown: false}}
            />
        </Stack.Navigator>
    )
}