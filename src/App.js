import React, {useState, useEffect} from 'react';
import { GraphContainer, GraphHeader } from './components/content';
import { LineChart, Line, CartesianGrid, XAxis, YAxis, Tooltip } from 'recharts';
import { Fragment } from 'react/cjs/react.production.min';
import { getViewsPerPeriod } from './services/actions';

function App() {
    const [data, setData] = useState([])
    const [period, setPeriod] = useState(1)

    async function getViews() {
        try {
            const {data} = await getViewsPerPeriod(period)
            setData(data.data)
        } catch (error) {
            console.log("An error occors when we request your data. Try again!")
        }
    }

    useEffect(() => {
        getViews()
    }, [period])

    return (
        <Fragment>
            <GraphHeader>
                <h4 style={{ marginBottom: 0 }}>Graph Widget</h4>
                <select onChange={e => setPeriod(e.target.value)} value={period}>
                    <option value="1">7 days</option>
                    <option value="2">15 days</option>
                    <option value="3">1 month</option>
                </select>
            </GraphHeader>
            <GraphContainer>
                <LineChart width={600} height={300} data={data} margin={{ top: 20 }}>
                    <Line type="monotone" dataKey="views" stroke="#8884d8" />
                    <CartesianGrid stroke="#ccc" strokeDasharray="5 5" />
                    <XAxis dataKey="page_name" />
                    <YAxis />
                    <Tooltip />
                </LineChart>
            </GraphContainer>
        </Fragment>
    )
}
export default App;